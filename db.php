<?php
ini_set("display_errors", 1);
error_reporting(E_ALL);
date_default_timezone_set('Asia/Calcutta');

/*LOGIN*/
function login($uid, $upd)
{
     
    $pdo=new PDO('mysql:host=localhost;port=3307;dbname=database name', 'userid', 'password');
    $sql = "SELECT * FROM credentials WHERE uid = :uid and upd = :upd ";
    $stmt=$pdo->prepare($sql);
    $stmt->execute(array(':uid'=>$uid,':upd'=>sha1($upd)));
    $row=$stmt->fetch(PDO::FETCH_ASSOC);
    return $row;
}

/*SIGN-UP*/
function sign_up($name,$email,$uid, $upd,$phno,$address)
{
     
    $pdo=new PDO('mysql:host=localhost;port=3307;dbname=database name', 'userid', 'password');
    $stmt2 = $pdo->query('SELECT * FROM credentials where uid="'. $uid.'"');
    $hashedpassword = sha1($upd);
    if ($row=$stmt2->fetch(PDO::FETCH_ASSOC))
    {
        echo "<p id='e'><br>User Id Already Exists!<br><p>";
    }
    else
    {
        $sql = 'INSERT INTO credentials (uid,upd,name,admin, email,phone,address,news) VALUES ("'.$uid.'","'.$hashedpassword.'","'.$name.'","no", "'.$email.'","'.$phno.'","'.$address.'","no")';
        if ($pdo->query($sql) === FALSE) 
        {
            echo "<br >Error <br>";
        }
        else
        {
            echo "<p id='g'>New account created successfully. Please login !<p>";
        }
       
    }
}

/*ALL-Products*/
function disp_all_products()
{    
    $pdo= new PDO('mysql:host=localhost;port=3307;dbname=srika', 'anjali', 'ctc');
    $stmt2 = $pdo->query('SELECT * FROM product');
    while($row=$stmt2->fetch(PDO::FETCH_ASSOC))
    {
        echo '<a id="soaps" href="viewpost.php?id='.$row['pid'].'"><h1 id="soaps">'.$row['pname'].'</h1>';
        echo '<img id="soaps" src="data:image;base64,'.base64_encode($row['img']).'"/></a>';              
    }
}

/*ACCOUNT-Soaps */  
function disp_account_orders($uno)
{
     
    $pdo=new PDO('mysql:host=localhost;port=3307;dbname=database name', 'userid', 'password');
    $stmt2 = $pdo->query('SELECT ono, odate, totalamt,quantity,status FROM orders where uno="'. $uno.'" ORDER BY odate DESC');
    while($row=$stmt2->fetch(PDO::FETCH_ASSOC))
    {
            echo '<h1>Order ID -- '.$row['ono'].'</h1>';
            echo '<p>Ordered on '.$row['odate'].'</p>';
            echo '<p>Total quantity '.$row['quantity'].'</p>';
            echo '<span id="rs">Total Amount -- R'.$row['totalamt'].'</span>';
            if ($row["status"]=="no")
            {
                echo '<p id="e">STATUS = NOT APPROVED<p>';
                echo '<form method="post">';
                echo '<input type="hidden" name="ono" value="'.$row["ono"].'">';
                echo '<button type="submit" name="delete">Delete order</button>';
                echo '</form>';
            }
            else
            {
                echo '<p id="g">STATUS = APPROVED<p>';
            }
            echo '<hr>'; 

    }
    if (isset($_POST["delete"]))
    {
        $stmt = $pdo->query('DELETE FROM orders where ono='. $_POST["ono"]);
        $row=$stmt->fetch(PDO::FETCH_ASSOC);
        echo '<p id="g">Order deleted . Please refresh!<p>';
    }
}  

/*Soap Information Update*/
function soap_info()
{
    $pdo= new PDO('mysql:host=localhost;port=3307;dbname=srika', 'anjali', 'ctc');
    $stmt2 = $pdo->query('SELECT * FROM product');
    echo "<table>";
    echo "<tr>";
    echo "<th>Soap No.</th>";
    echo "<th>Soap Name</th>";
    echo "<th>Price</th>";
    echo "<th>Quantity</th>";
    echo "<th>Description</th>";
    echo "<th>Image Upload</th>";
    echo "<th>Update</th>";
    echo "<th>Delete</th>";
    echo "</tr>";
    while($row=$stmt2->fetch(PDO::FETCH_ASSOC))
    {
        echo '<form method="post" enctype="multipart/form-data">';
        echo "<tr>";
        echo '<td><input type="number" name="pid" value="'.$row['pid'].'" readonly></input></td>';
        echo '<td><input type="text" name="pname" value="'.$row['pname'].'"></input></td>';
        echo '<td><input type="number" name="price" value="'.$row['price'].'"></input></td>';
        echo '<td><input type="number" name="quantity" value="'.$row['quantity'].'"></input></td>';
        echo '<td><textarea name="descp" rows="20" class="content_textarea">'.$row['descp'].'</textarea></td><br>';
        echo '<td><input type="file" name="img"/></td>';
        echo '<td><button name="update_button"> Update Information</button></td>';
        echo '<td><button name="delete_button"> Delete Information</button></td>';
        echo "</tr>"; 
        echo '</form>';
                      
    }
    echo "</table>";
    echo "<br>";
    echo "<a href='account.php'> Back </a>";
    if (isset($_POST["update_button"]))
    {
        if (empty($_FILES["img"]))
        {
            $file=$_FILES["img"];
            $filename=$_FILES["img"]["name"];
            $fileTmpName=$_FILES["img"]["tmp_name"];
            $fp = fopen($fileTmpName, 'rb');
            $fileSize=$_FILES["img"]["size"];
            $fileError=$_FILES["img"]["error"];
            $fileType=$_FILES["img"]["type"];
            $ext=explode('.', $filename);
            $fileExt=strtolower(end($ext));
            $allowed = array('jpg','jpeg','png');
            if (in_array($fileExt, $allowed))
            {
                if ($fileError === 0)
                {
                    if ($fileSize<2000000) 
                    {
                        try
                        {
                           $stmt = $pdo->prepare("UPDATE product SET img=:img where pid=:pid");
                           $stmt->bindParam(':img', $fp, PDO::PARAM_LOB);
                           $stmt->bindParam(':pid', $_POST["pid"], PDO::PARAM_INT);
                           $pdo->errorInfo();
                           $stmt->execute();
                           updating_soap_info($_POST["pid"],$_POST["pname"],$_POST["price"],$_POST["quantity"],$_POST["descp"]);
                        }
                        catch(PDOException $e)
                        {
                           'Error : ' .$e->getMessage();
                        }
                   }   
                   else
                   {
                        echo "Enter image less than / equal to 2mb";
                   }
                }
                else
                {
                    echo "Error uploading this image";
                }
            }
            else
            {
                echo "You cannot upload this extension image";
            }
        }
        else
        {
            updating_soap_info($_POST["pid"],$_POST["pname"],$_POST["price"],$_POST["quantity"],$_POST["descp"]);
        }
    }
    if (isset($_POST["delete_button"]))
    {
        delete_soap_info($_POST["pid"]);
    }
}

/*Updating soap info*/
function updating_soap_info($pid,$pname,$price,$quantity,$descp)
{
    $pdo=new PDO('mysql:host=localhost;port=3307;dbname=database name', 'userid', 'password');
    $sql='UPDATE product SET pname=?,price=?,quantity=?,descp=? where pid=?';

    $stmt = $pdo->prepare($sql);
    if ($stmt->execute([$pname,$price,$quantity,$descp,$pid]) === TRUE )
    {
       echo "<p id='g'>Information edit successful. Please refresh !<p>";
    }
    else
    {
        echo "<p id='e'>Information edit unsuccessful. Try Again !<p>";
    }

}

/*VIEW-POST*/   
function view_post($pid)
{
     
    $pdo= new PDO('mysql:host=localhost;port=3307;dbname=srika', 'anjali', 'ctc');
    $stmt2 = $pdo->query('SELECT * FROM product where pid="'.$pid.'"');
    while($row=$stmt2->fetch(PDO::FETCH_ASSOC))
    {
        echo "<div class='soapdisp'>";
        echo '<h1 id="soaps">'.$row['pname'].'</h1><hr>';
        echo '<img id="soaps" src="data:image;base64,'.base64_encode($row['img']).'"/>'; 
        echo '<p>'.$row['descp'].'</p>';   
        echo '<span id="rs">R'.$row['price'].'</span><br>';   
        echo '<form method="post">' ;
        echo '<input type="hidden" name="price" value="'.$row['price'].'">';
        echo '<input type="hidden" name="pname" value="'.$row['pname'].'">';
        echo '<input type="number" placeholder="Quantity" name="quantity" required>';
        echo '<button class="btn" type="submit" name="cart">Add to cart</button>';       
        echo '</form>';
        echo '</div>';
    }
    if (isset($_POST["cart"]))
    {
        if (isset($_SESSION["logged_in"]))
        {
            $p=(int)$_POST["quantity"]*(int)$_POST["price"];
             $sql = 'INSERT INTO cart (uno,pid,pname,quantity,price,total) VALUES ("'.$_SESSION["uno"].'","'.$_GET["id"].'","'.$_POST["pname"].'", "'.$_POST["quantity"].'","'.$_POST["price"].'","'.$p.'")';
            if ($pdo->query($sql) === FALSE) 
            {
                echo "<br >Error <br>";
            }
            else
            {
                echo "<p id='g'>Product added successfully. Check in cart !<p>";
            }
        }
        else
        {
            echo '<p id="e">Please login to add to cart!!</p>'; 
        }
    }

}     
/*Create Soap Entry*/
function entry()
{
     $pdo= new PDO('mysql:host=localhost;port=3307;dbname=srika', 'anjali', 'ctc');
    echo '<h1>Enter soap details . .</h1>';
    echo '<form method="post" enctype="multipart/form-data">';
    echo '<input type="text" name="pname" placeholder="Enter soap name here" required/>';
    echo '<input type="text" name="price" placeholder="Enter soap price here" required/>';
    echo '<input type="text" name="quantity" placeholder="Enter soap quantity here"  required/>';
    echo '<textarea name="descp" rows="20" class="content_textarea" placeholder="Enter soap description here . . . . ." required></textarea><br>'; 
    echo '<input type="file" name="img"/><br><br>';  
    echo '<button name="create_button"> Create Entry</button>';
    echo '</form>';       
    echo '<p><a href="account.php"> Back</a></p>';  

    if (isset($_POST['create_button']))
    {
        if (isset($_FILES["img"]))
        {
            echo "here";
            $file=$_FILES["img"];
            $filename=$_FILES["img"]["name"];
            $fileTmpName=$_FILES["img"]["tmp_name"];
            $fp = fopen($fileTmpName, 'rb');
            $fileSize=$_FILES["img"]["size"];
            $fileError=$_FILES["img"]["error"];
            $fileType=$_FILES["img"]["type"];
            $ext=explode('.', $filename);
            $fileExt=strtolower(end($ext));
            $allowed = array('jpg','jpeg','png');
            if (in_array($fileExt, $allowed))
            {
                if ($fileError===0)
                {
                    if ($fileSize<2000000) 
                    {
                        try
                        {
                           $stmt = $pdo->prepare("INSERT into product (pname,price,quantity,descp,img) values (?,?,?,?,?)");
                           $stmt->bindParam(1, $_POST["pname"], PDO::PARAM_STR);
                           $stmt->bindParam(2, $_POST["price"], PDO::PARAM_INT);
                           $stmt->bindParam(3, $_POST["quantity"], PDO::PARAM_INT);
                           $stmt->bindParam(4, $_POST["descp"], PDO::PARAM_STR);
                           $stmt->bindParam(5, $fp, PDO::PARAM_LOB);
                           $pdo->errorInfo();
                           $stmt->execute();
                        }
                        catch(PDOException $e)
                        {
                           'Error : ' .$e->getMessage();
                        }
                     }   
                    else
                    {
                       echo "Enter image less than / equal to 2mb";
                    }
                }
                else
                {
                     echo "There was an error uploading your file";
                }
            }
            else
            {
                echo "You cannot upload this extension image";
            }
        }
        else
        {
            echo "<p id='e'>Enter image also!!</p>";
            var_dump($_FILES);
        }
    }
}

/*Creating entry*/
function creating($pname,$price,$quantity,$descp)
{
     
    $pdo=new PDO('mysql:host=localhost;port=3307;dbname=database name', 'userid', 'password');
    $sql = 'INSERT INTO product (pname,price,quantity,descp) VALUES ("'.$pname.'","'.$price.'", "'.$quantity.'","'.$descp.'")';
    if ($pdo->query($sql) === FALSE) 
    {
        echo "<p id='e'>Error!<p><br>";
    }
    else
    {
        $sql = "SELECT pid FROM product WHERE pname='". $pname."'";
        $stmt=$pdo->query($sql);
        $row=$stmt->fetch(PDO::FETCH_ASSOC);
        return $row["pid"];
    }
}

/*Updating user info*/
function updating_user_info($uno,$uid,$upd,$name,$admin,$email,$phone,$address)
{
     
    $pdo=new PDO('mysql:host=localhost;port=3307;dbname=database name', 'userid', 'password');
    $sql='UPDATE credentials SET upd=?,name=?,admin=?,email=?,phone=?,address=? where uno=?';
    $stmt = $pdo->prepare($sql);
    if ($stmt->execute([$upd,$name,$admin,$email,$phone,$address,$uno]) === TRUE )
    {
        return "pass";
    }
    else
    {
        echo "<p id='e'>Information Update unsuccessful. Try Again !<p>";
    }
}

function updating_no_pass_info($uno,$uid,$name,$admin,$email,$phone,$address)
{
     
    $pdo=new PDO('mysql:host=localhost;port=3307;dbname=database name', 'userid', 'password');
    $sql='UPDATE credentials SET name=?,admin=?,email=?,phone=?,address=? where uno=?';
    $stmt = $pdo->prepare($sql);
    if ($stmt->execute([$name,$admin,$email,$phone,$address,$uno]) === TRUE )
    {
        return "pass";
    }
    else
    {
        echo "<p id='e'>Information Update unsuccessful. Try Again !<p>";
    }
}


/*Delete Soap Info*/
function delete_soap_info($pid)
{
     
    $pdo=new PDO('mysql:host=localhost;port=3307;dbname=database name', 'userid', 'password');
    $stmt2 = $pdo->query('DELETE FROM product where pid='. $pid);
    $row=$stmt2->fetch(PDO::FETCH_ASSOC);
    echo "<p id='g'>User deleted successfully . Please refresh!<p>";
}

/*personal info*/
function personal_info($uid,$uno)
{
     
    $pdo=new PDO('mysql:host=localhost;port=3307;dbname=database name', 'userid', 'password');
    $stmt2 = $pdo->query('SELECT uno,uid,name,admin, email,phone,address FROM credentials where uno="'.$uno.'"');
    $ad="";
    echo "<table>";
    echo "<tr>";
    echo "<th>User No. </th>";
    echo "<th>User ID</th>";
    echo "<th>User Password</th>";
    echo "<th>Name</th>";
    echo "<th>Admin</th>";
    echo "<th>Email</th>";
    echo "<th>PhoneNo</th>";
    echo "<th>Address</th>";
    echo "<th>Update</th>";
    echo "</tr>";
    
    while ($row=$stmt2->fetch(PDO::FETCH_ASSOC))
    {
         echo '<form method="post">';
        echo "<tr>";
        echo '<td><input type="text" name="uno" value="'.$row['uno'].'" readonly></input></td>';
        echo '<td><input type="text" name="uid" value="'.$row['uid'].' " readonly></input></td>';
        echo '<td><input type="password" name="upd" placeholder="Password"></input></td>';
        echo '<td><input type="text" name="name" value="'.$row['name'].'"></input></td>';
        echo '<td><input type="text" name="admin" value="'.$row['admin'].'" readonly></td>';
        echo '<td><input type="email" name="email" value="'.$row['email'].'""></input></td>';
        echo '<td><input type="number" name="phone" value="'.$row['phone'].'""></input></td>';
        echo '<td><textarea name="address" rows="20" class="content_textarea">'.$row['address'].'</textarea></td><br>';
        echo '<td><button name="update_button"> Update Information</button></td>';
        echo "</tr>"; 
        echo '</form>';
        $ad=$row['admin'];
    }
        
    echo "</table>";
    echo "<br>";
    echo "<a href='account.php'> Back </a>";
    if (isset($_POST["update_button"]))
    {
        if (empty($_POST["upd"]))
        {
            if (updating_no_pass_info($_POST["uno"],$_POST["uid"],$_POST["name"],$_POST["admin"],$_POST["email"],$_POST["phone"],$_POST["address"])=="pass")
            {
                header("LOCATION: logout.php");
            }
        
        }
        else
        {
            if (updating_user_info($_POST["uno"],$_POST["uid"],sha1($_POST["upd"]),$_POST["name"],$ad,$_POST["email"],$_POST["phone"],$_POST["address"])=="pass")
            {
                header("LOCATION: logout.php");
            }

        }
    }
}

/*News-letter Sign-up*/
function newsletter($uno)
{
    $pdo=new PDO('mysql:host=localhost;port=3307;dbname=database name', 'userid', 'password');
    $sql = "SELECT news FROM credentials WHERE uno='". $uno."'";
    $stmt=$pdo->query($sql);
    $row=$stmt->fetch(PDO::FETCH_ASSOC);
    if($row["news"]=='yes')
    {
        echo "<p id='g'>You are already subscribed !<p>";
    }
    else
    {
        $news="yes";
        $sql='UPDATE credentials SET news=? where uno=?';
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([$news,$uno]) === TRUE )
        {
           echo "<p id='g'>Subscribed successfully. Please refresh !<p>";
        }
        else
        {
            echo "<p id='e'>Subscribed unsuccessfully. Try Again !<p>";
        }
    }
}

/*Quiz*/
function quiz($q1,$q2,$q4)
{
    $pid=array("0");
    if ($q2=="scrub")
    {
        array_push($pid, "6");
    }
    else
    {
        if ($q4=="acne")
        {
            array_push($pid, "1","2");
        }
        if ($q4 == "refreshing")
        {
            array_push($pid, "3","4","5");
        }
        if ($q4 == "ageing")
        {
            array_push($pid, "1","2");
        }
    }
    $pdo= new PDO('mysql:host=localhost;port=3307;dbname=srika', 'anjali', 'ctc');
    $p=implode(",",$pid);
    $stmt2 = $pdo->query('SELECT * FROM product where pid in ('.$p.')');
    while($row=$stmt2->fetch(PDO::FETCH_ASSOC))
    {
        echo '<a id="soaps" href="viewpost.php?id='.$row['pid'].'"><h1 id="soaps">'.$row['pname'].'</h1>';
        echo '<img id="soaps" src="data:image;base64,'.base64_encode($row['img']).'"/></a>';              
    }

}

/* Cart */
function cart($uno,$uid)
{
    $pdo= new PDO('mysql:host=localhost;port=3307;dbname=srika', 'anjali', 'ctc');
    $stmt2 = $pdo->query('SELECT * FROM cart where uno="'.$uno.'"');
    $total=0;
    echo "<table>";
    echo "<tr>";
    echo "<th>Product Name</th>";
    echo "<th>Product price</th>";
    echo "<th>Quantity</th>";
    echo "<th>Total Price</th>";
    echo "<th>Update Quantity</th>";
    echo "<th>Delete Product</th>";
    echo "</tr>";
    $qty=0;
    while ($row=$stmt2->fetch(PDO::FETCH_ASSOC))
    {
        echo "<tr>";
        echo '<form method= "post">';
        echo '<td><input type="text" value="'.$row['pname'].'" name="pname" readonly></input></td>';
        echo '<td><input type="text" value="'.$row['price'].'" name="price" readonly></td>';
        echo '<td><input type="number" value="'.$row['quantity'].'" name="qty"></input></td>';
        echo '<td>'.$row['total'].'</input></td>';
        echo '<td><button type="submit" name="update">Update</button></td>';
        echo '<td><button type="submit" name="delete">Delete</button></td>';
        echo "</tr>"; 
        $qty=$qty+(int)$row["quantity"];
        $total=$total+(int)$row["total"];
    }     
    echo "</table>";
    echo "<br><br>";
    echo "Total amount=  ".$total;
    echo '<form method="post">';
    echo '<br><input type="text" placeholder="Coupon code?" name="coupon"/>';
    echo '<button name="place"> Place Order</button>';
    echo '</form>';
    if (isset($_POST["place"]))
    {
            receipt($total,$qty,$uno,$uid,$_POST["coupon"]);
    }
    if (isset($_POST["update"]))
    {
        $t=(int)$_POST["qty"]*(int)$_POST["price"];
        $sql='UPDATE cart SET quantity=?,total=? where pname=?';
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([$_POST["qty"],$t,$_POST["pname"]]) === TRUE )
        {
            echo "<p id='g'>Information Update successful. Please refresh !<p>";
        }
    }
    if (isset($_POST["delete"]))
    {
        $pdo=new PDO('mysql:host=localhost;port=3307;dbname=database name', 'userid', 'password');
        $stmt2 = $pdo->query('DELETE FROM cart where pname="'.$_POST["pname"].'" and quantity="'.$_POST["qty"].'"');
        $row=$stmt2->fetch(PDO::FETCH_ASSOC);
        echo "<p id='g'>Product deleted successfully . Please refresh!<p>";
    }
}

/*Receipt*/
function receipt($total,$qty,$uno,$uid,$coupon)
{
    $pdo=new PDO('mysql:host=localhost;port=3307;dbname=database name', 'userid', 'password');
    if (($uid == $coupon))
    {
        echo "You cannot use your own coupon!!";
    }
    else
    {
        $sql = "SELECT uid FROM credentials WHERE uid='". $coupon."'";
        $stmt=$pdo->query($sql);
        if ($row=$stmt->fetch(PDO::FETCH_ASSOC))
        {
            $total=$total-100;
        }
        else
        {
            echo "invalid coupon";
        }
    }
    $sql1 = 'INSERT INTO orders (uno,uid,odate,quantity,totalamt,status) VALUES ("'.$uno.'","'.$uid.'","'.date('y-m-d').'", "'.$qty.'","'.$total.'","no")';
    $pdo->query($sql1);
    $sql='DELETE FROM cart WHERE uno = "'.$uno.'"';
    $stmt = $pdo->prepare($sql);
    if ($stmt->execute() === TRUE )
    {
        header("LOCATION: account.php");
    }
    else
    {
        echo "FAILED";
    }
}

/*update-orders*/
function update_order()
{
    $pdo=new PDO('mysql:host=localhost;port=3307;dbname=database name', 'userid', 'password');
    $sql = "SELECT * FROM orders";
    $stmt=$pdo->query($sql);
    echo "<table>";
    echo "<tr>";
    echo "<th>User No. </th>";
    echo "<th>User ID</th>";
    echo "<th>Order No.</th>";
    echo "<th>Order Date</th>";
    echo "<th>Quantity</th>";
    echo "<th>Total Amount</th>";
    echo "<th>Status</th>";
    echo "<th>Update</th>";
    echo "</tr>";
    while ($row=$stmt->fetch(PDO::FETCH_ASSOC))
    {
        echo '<form method="post">';
        echo "<tr>";
        echo '<td>'.$row['uno'].'</td>';
        echo '<td>'.$row['uid'].'</td>';
        echo '<td><input type="text" name="ono" value="'.$row['ono'].'" readonly></td>';
        echo '<td>'.$row['odate'].'</td>';
        echo '<td>'.$row['quantity'].'</td>';
        echo '<td>'.$row['totalamt'].'</td>';
        echo '<td>'.$row['status'].'</td>';
        echo '<td><button name="update_button"> Update Information</button></td>';
        echo "</tr>"; 
        echo '</form>';
    }
    echo "</table>";
    if (isset($_POST["update_button"]))
    {
        $sql='UPDATE orders SET status=? where ono=?';
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute(["yes",$_POST["ono"]]) === TRUE )
        {
            echo "<p id='g'>Information Update successful. Please refresh !<p>";
        }
        else
        {
            echo "<p id='e'>Information Update unsuccessful. Try Again !<p>";
        }
    }
}

/*Add Customize soap to cart*/
function customize($uno,$q1,$q2,$q3,$q4)
{
      $pdo= new PDO('mysql:host=localhost;port=3307;dbname=srika', 'anjali', 'ctc');
      $sql = 'INSERT INTO cart (uno,pid,pname,quantity,price,total) VALUES ("'.$uno.'","10","'.$q1.$q2.$q3.$q4.'", "1","150","150")';
      if ($pdo->query($sql) === FALSE) 
      {
          echo "<br >Error <br>";
      }
      else
      {
          echo "<p id='g'>Product added successfully. Check in cart !<p>";
      }
}

/*Forgot Password*/
function forgot($uid,$email,$upd)
{
    $pdo= new PDO('mysql:host=localhost;port=3307;dbname=srika', 'anjali', 'ctc');
    $sql='UPDATE credentials SET upd=? where uid=? and email=? ';
    $stmt = $pdo->prepare($sql);
    if ($stmt->execute([sha1($upd),$uid,$email]) === TRUE )
    {
        echo "<p id='g'>Information Update successful. Please re-login !<p>";
    }
    else
    {
        echo "<p id='e'>Information Update unsuccessful. Try Again !<p>";
    }
}