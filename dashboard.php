<?php
session_start();
include_once "./db_config.php";
if (!isset($_SESSION['username']) ){?>
    <script type="text/javascript">
    window.location = "login.php";
    </script>
    <?php
    }
$username=$_SESSION["username"];

$result = mysqli_query($conn, "SELECT * FROM  $username ");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Welcome</title>
    <link rel="icon" href="https://s3.ap-south-1.amazonaws.com/clouddms.in/clouds__dms.png">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">

    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>

</head>

<body>

    <nav class="navbar ">
        <div class="container-fluid" style="background-color:#6D4A70;">
            <div class="navbar-header">
                <a class="navbar-brand" href="" style="color: white;">Welcome</a>
            </div>
            <ul class="nav navbar-nav" style="float: right; ">
                <li class=""><a href="logout.php" style="color:white;" onMouseOver="this.style.color='black'" onMouseOut="this.style.color='white'">Logout</a></li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <div class="card" style="margin: 20px;">
            <div>
                <button class="btn btn-primary" id="show" onclick="show();">ADD</button>
            </div>
            <div>
                <div class="card" id="card" style="display: none;">
                    <div class="card-body">
                        <h4><b>Fill Details</b></h4>
                        <div class="row">
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="name2" value="" placeholder="Name" />
                            </div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="email2" value="" placeholder="Email" />
                            </div>
                            <div class="col-sm-4">
                                <input type="number" class="form-control" maxlength="10" id="phone2" value="" placeholder="Contact" />
                            </div>
                        </div>
                        <br>
                        <button class="btn btn-primary" onclick="add();">Submit</button>
                    </div>
                </div>
            </div>
            <div class="card" id="card1" style="display: none;">
                <div class="card-body">
                <h4><b>Edit Details</b></h4>
                        <div class="row">
                            <div class="col-sm-4">
                            <input type="text" class="form-control" id="name1" value="" placeholder="Name" />
                            </div>
                            <div class="col-sm-4">
                            <input type="text" class="form-control" id="email1" value="" placeholder="Email" />
                            </div>
                            <div class="col-sm-4">
                            <input type="number" class="form-control" id="phone1" value="" placeholder="Contact" />
                            </div>
                        </div>
                        <br>
                    <button class="btn btn-primary" onclick="edit();">Update</button>
                </div>
            </div>
        </div>
        <table id="table_id" class="table table-striped table-bordered  ">
            <thead>
                <tr>
                    <th width="5px">#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th></th>
                    <th></th>

                </tr>
            </thead>
            <tbody id="tbody">
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                    <tr id="<?php echo $row['id']; ?>">
                        <td></td>
                        <td id="<?php echo $row['id']."name"; ?>">
                            <?php echo $row['name']; ?>
                        </td>
                        <td id="<?php echo $row['id']."email"; ?>">
                            <?php echo $row['email']; ?> 
                        </td>
                        <td id="<?php echo $row['id']."contact"; ?>">
                            <?php echo $row['contact']; ?>
                        </td>
                        <td><a class="btn btn-sm btn-success" id="edit" onclick="show1('<?php echo $row['id']; ?>','<?php echo $row['name']; ?>','<?php echo $row['email']; ?>','<?php echo $row['contact']; ?>');">Edit</a></td>
                        <td><a class="btn btn-sm btn-danger" id="remove" onclick="remove('<?php echo $row['id']; ?>');">Remove</a></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th></th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
    </div>
    <script>
        $(document).ready(function() {
            $("#table_id").DataTable();
        });
            var t = $('#table_id').DataTable();

        var ide = '';

        function show() {
            document.getElementById("card").style.display = "block";
            document.getElementById("show").style.display = "none";
        }
        function show1(id,name,email,contact) {
            document.getElementById("card1").style.display = "block";
            document.getElementById("show").style.display = "none";
           document.getElementById("name1").value=name;
            document.getElementById("email1").value=email;
            document.getElementById("phone1").value=contact;
            ide = id;
        }

        function logout() {
            window.location.href = "login.php";
        }

        function add() {
            var work = "add";
            var name = document.getElementById("name2").value;
            var email = document.getElementById("email2").value;
            var phone = document.getElementById("phone2").value;
            if (name && email && phone) {
                var tbody = document.getElementById('tbody');
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        if (this.response != 0) {
                            alert("Member Added Successfully");
                            $(".dataTables_empty").hide();
                            $("#table_id_info").hide();
                            var c = document.createElement("BUTTON");
                            c.type = 'button';
                            c.setAttribute("class", "btn btn-sm btn-success");
                            c.setAttribute("id", "edit");
                            c.innerHTML = "<a style='color:#fff;' >Edit</a>";
                            c.setAttribute("onclick", 'show1('+ this.response + ',"' + name + '","' + email + '","' + phone + '")');
                            var d = document.createElement("BUTTON");
                            d.type = 'button';
                            d.setAttribute("class", "btn btn-sm btn-danger");
                            d.setAttribute("id", "remove");
                            d.innerHTML = "<a style='color:#fff;' >Remove</a>";
                            d.setAttribute("onclick", 'remove(' + this.response + ')');
                            let row_2 = document.createElement('tr');
                            row_2.setAttribute("id", this.response);
                            let row_2_data_1 = document.createElement('td');
                            row_2_data_1.innerHTML = "";
                            let row_2_data_2 = document.createElement('td');
                            row_2_data_2.innerHTML = name;
                            row_2_data_2.setAttribute("id",this.response+"name");
                            let row_2_data_3 = document.createElement('td');
                            row_2_data_3.innerHTML = email;
                            row_2_data_3.setAttribute("id",this.response+"email");
                            let row_2_data_4 = document.createElement('td');
                            row_2_data_4.innerHTML = phone;
                            row_2_data_4.setAttribute("id",this.response+"contact");
                            let row_2_data_5 = document.createElement('td');
                            row_2_data_5.appendChild(c);
                            let row_2_data_6 = document.createElement('td');
                            row_2_data_6.appendChild(d);
                            row_2.appendChild(row_2_data_1);
                            row_2.appendChild(row_2_data_2);
                            row_2.appendChild(row_2_data_3);
                            row_2.appendChild(row_2_data_4);
                            row_2.appendChild(row_2_data_5);
                            row_2.appendChild(row_2_data_6);
                            tbody.appendChild(row_2);
                            document.getElementById("name2").value = '';
                            document.getElementById("email2").value = '';
                            document.getElementById("phone2").value = '';
                            document.getElementById("card").style.display = "none";
                            document.getElementById("show").style.display = "block";
                        }
                    }
                }
                xmlhttp.open("GET", "data.php?work=" + work + "&&name=" + name + "&&email=" + email + "&&phone=" + phone, true);
                xmlhttp.send();
            } else {
                alert("Fill all details");
            }
        }
        function edit() {
            work = "update";
            var name = document.getElementById("name1").value;
            var email = document.getElementById("email1").value;
            var phone = document.getElementById("phone1").value;
            if (name && email && phone) {
                var tbody = document.getElementById('tbody');
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        if (this.response == '1') {
                            alert("Updated Successfully");
                            document.getElementById(ide+"name").innerHTML=name;
                            document.getElementById(ide+"email").innerHTML=email;
                            document.getElementById(ide+"contact").innerHTML=phone;
                            document.getElementById("name1").value = '';
                            document.getElementById("email1").value = '';
                            document.getElementById("phone1").value = '';
                            document.getElementById("card1").style.display = "none";
                            document.getElementById("show").style.display = "block";
                        }
                    }
                }
                xmlhttp.open("GET", "data.php?work=" + work + "&&name=" + name + "&&email=" + email + "&&phone=" + phone + "&&id=" + ide, true);
                xmlhttp.send();
            } else {
                alert("Fill all details");
            }

        }

        function remove(id) {
            work = "remove";
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {

                    if (this.response == '1') {
                        alert("Member Removed Successfully");
                        $("#table_id_info").hide();
                        document.getElementById(id).style.display = "none";
                    }
                }
            }
            xmlhttp.open("GET", "data.php?work=" + work + "&&id=" + id, true);
            xmlhttp.send();

        }
    </script>

</body>

</html>