<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;400&display=swap" rel="stylesheet">
    
    <!-- End Carousal -->
    <!-- JS -->
   
<!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script> -->
<script type="text/javascript" src="../public/assets/js/header.js"></script>
<script type="text/javascript" src="../public/assets/js/weather.js"></script>
<script type="text/javascript" src="../public/assets/js/lightslider.js"></script>
    <link rel="stylesheet" href="../public/assets/css/style.css">
    <link type="text/css" rel="stylesheet" href="../public/assets/css/lightslider.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/dataTables.jqueryui.min.css"/>
<link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"/>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/dataTables.jqueryui.min.js"></script>
<style>
    .actived {
        color: black !important;
    }
    #addVendor {
        display: none;
    }
</style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container cust-border bg-white">
            <a class="navbar-brand">
                <img src="../public/assets/images/logofah.png" alt="" width="100" height="85" class="d-inline-block align-text-top img-fluid">   
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="nav nav-tabs" id="nav-tab" role="tablist" style="margin-right: auto;">
                    <button class="nav-link act active actived" onclick="hideButton()" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true" style="color:#182c6d;">Customers</button>
                    <button class="nav-link act" onclick="showButton()" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false" style="color:#182c6d;">Vendors</button>
                </div>
                <div class="d-flex align-items-center">
                    <button type="submit" id="addVendor" name="submit" class="btn custbtn float-end hidden" data-bs-toggle="modal" data-bs-target="#vendorInsert" style="margin-right: 30px; margin-bottom: 24px;">Add Vendor</button>
                    <div class="pt-3 d-flex flex-column align-items-center">
                        <button type="button" class="btn custbtn" style="" ><a class="text-decoration-none" href="<?= base_url('FAH/Login/logout');?>" style="color:white;">Logout</a></button>
                        <p class="align-center">Admin Name</p>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <script>
    function showButton() {
    var x = document.getElementById("addVendor");
        x.style.display = "block";
    }
    function hideButton() {
    var x = document.getElementById("addVendor");
    if (x.style.display === "block") {
        x.style.display = "none";
    } else {
        x.style.display = "none";
    }
    }
    </script>
    <script>
        // Add active class to the current button (highlight it)
        var header = document.getElementById("nav-tab");
        var btns = header.getElementsByClassName("act");
        console.log(btns.length);
        for (var i = 0; i < btns.length; i++) {
        btns[i].addEventListener("click", function() {
        var current = document.getElementsByClassName("actived");
        current[0].className = current[0].className.replace(" actived", "");
        this.className += " actived";
        });
        }
    </script>
<!-- Customers Table -->

<div class="tab-content" id="nav-tabContent">
    <div class="tab-pane logsbody fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
        <div class="col-12" id="logintable">
            <div class="container table-responsive mt-1">
                <div class="row">
                <h3>Customers Detail:</h3><br>
                <?php if(session()->getTempdata('errorcust')): ?>
                <div class="alert alert-danger"> <?= session()->getTempdata('errorcust'); ?> </div>
                <?php endif; ?>
                <?php if(session()->getTempdata('successcust')): ?>
                <div class="alert alert-success"> <?= session()->getTempdata('successcust'); ?> </div>
                <?php endif; ?>
                <table id="customerlist" class="table table-bordered table-hover align-middle" style="background: white; border-radius: 2px;">
                    <thead>
                        <tr>
                        <th>View</th>
                        <th>Update</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Reset Password</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php for($i=0;$i<count($customerdata);$i++){ $values=$customerdata[$i]; ?>
                        <tr>
                        <td class="text-center">
                            <button type="submit" name="submit" class="btn custbtn"><a class="text-decoration-none" href="customerView?id=<?=$values['UID']?>" style="color:white;">View</a></button>
                        </td>
                        <td class="text-center"><button id="valueforward" data-uid="<?=$values['UID']?>" data-fid="<?=$values['FIRST_NAME']?>" data-lid="<?=$values['LAST_NAME']?>" data-eid="<?=$values['EMAIL']?>" type="submit" name="submit" class="btn custbtn" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Update</button></td>
                        <td><?=$values['FIRST_NAME']?></td>
                        <td><?=$values['LAST_NAME']?></td>
                        <td><?=$values['EMAIL']?></td>
                        <td class="text-center"><form action="resetpasswordcustomerLink" method="post">
                        <input type="text" name="EMAIL" value="<?=$values['EMAIL']?>" class="d-none"/>
                        <button id="resetbtn" name="submit" type="submit" class="btn custbtn">Send Mail</button>
                        </form></td>                        
                        </tr>
                    <?php }?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Customers Detail Update</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="updateCustomer" method="post">
                            <input id="uid" type="text" name="uid" class="form-control d-none" value=""/>
                            <div class="mb-3">
                                <label class="form-label">First Name</label>
                                <input id="fid" type="text" name="newfirstname" class="form-control" value="">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Last Name</label>
                                <input id="lid" type="text" name="newlastname" class="form-control" value="">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email address</label>
                                <input id="eid" type="email" name="newemail" class="form-control" value="">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn custbtn">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script>
        $(document).on("click", "#resetbtn", function (){
        var email = $(this).data('email');
        $("#email").val( email );
        });

        $(document).on("click", "#valueforward", function () {
            
            var userid = $(this).data('uid');
            $(".modal-body #uid").val( userid );
        
            var fvalue = $(this).data('fid');
            $(".modal-body #fid").val( fvalue );

            var lvalue = $(this).data('lid');
            $(".modal-body #lid").val( lvalue );
        
            var evalue = $(this).data('eid');
            $(".modal-body #eid").val( evalue );
        }); 
        </script>
        <script>
            $(document).ready( function () {
            $('#customerlist').DataTable();
        } );
        </script>
    </div>
</div>

<!-- Vendors Table -->

<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
    <div class="container table-responsive mt-1">
        <div class="row">
            <div class="mb-2">
                <h3>Vendors Detail:</h3>
            </div>
            <?php if(session()->getTempdata('errorvend')): ?>
            <div class="alert alert-danger"> <?= session()->getTempdata('errorvend'); ?> </div>
            <?php endif; ?>
            <?php if(session()->getTempdata('successvend')): ?>
            <div class="alert alert-success"> <?= session()->getTempdata('successvend'); ?> </div>
            <?php endif; ?>
            <table id="vendorlist" class="table table-bordered table-hover align-middle" style="background: white; border-radius: 2px;">
                <thead>
                    <tr>
                    <th>View</th>
                    <th>Update</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Reset Password</th>
                    </tr>
                </thead>
                <tbody>
                <?php for($i=0;$i<count($vendordata);$i++){ $values=$vendordata[$i]; ?>
                    <tr>
                    <td class="text-center"><button id="uidpass" data-uid="<?=$values['UID']?>" data-fid="<?=$values['FIRST_NAME']?>" data-lid="<?=$values['LAST_NAME']?>" data-eid="<?=$values['EMAIL']?>" type="submit" name="submit" class="btn custbtn">View</button></td>
                    <td class="text-center"><button id="valuepass" data-uid="<?=$values['UID']?>" data-fid="<?=$values['FIRST_NAME']?>" data-lid="<?=$values['LAST_NAME']?>" data-eid="<?=$values['EMAIL']?>" type="submit" name="submit" class="btn custbtn" data-bs-toggle="modal" data-bs-target="#vendorUpdate">Update</button></td>
                    <td><?=$values['FIRST_NAME']?></td>
                    <td><?=$values['LAST_NAME']?></td>
                    <td><?=$values['EMAIL']?></td>
                    <td class="text-center"><form action="resetpasswordvendorLink" method="post">
                    <input type="text" name="EMAIL" value="<?=$values['EMAIL']?>" class="d-none"/>
                    <button id="resetbtn" name="submit" type="submit" class="btn custbtn">Send Mail</button>
                    </form>
                    </td>                        
                    </tr>
                <?php }?>
                </tbody>
            </table>
        </div>
    </div>


    <div class="modal fade" id="vendorUpdate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Customers Detail Update</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="updateVendor" method="post">
                        <input id="uid" type="text" name="uid" class="form-control d-none" value=""/>
                        <div class="mb-3">
                            <label class="form-label">First Name</label>
                            <input id="fid" type="text" name="newfirstname" class="form-control" value="">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Last Name</label>
                            <input id="lid" type="text" name="newlastname" class="form-control" value="">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email address</label>
                            <input id="eid" type="email" name="newemail" class="form-control" value="">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn custbtn">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="vendorInsert" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Insert New Vendor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="insertVendor" method="post">
                        <div class="mb-3">
                            <label class="form-label">First Name</label>
                            <input type="text" name="firstname" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Last Name</label>
                            <input type="text" name="lastname" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email address</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn custbtn">Insert</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
    $(document).on("click", "#resetbtn", function (){
    var email = $(this).data('email');
    $("#email").val( email );
    });

    $(document).on("click", "#valuepass", function () {
        
        var userid = $(this).data('uid');
        $(".modal-body #uid").val( userid );

        var fvalue = $(this).data('fid');
        $(".modal-body #fid").val( fvalue );

        var lvalue = $(this).data('lid');
        $(".modal-body #lid").val( lvalue );

        var evalue = $(this).data('eid');
        $(".modal-body #eid").val( evalue );
    }); 
    </script>
    <script>
        $(document).ready( function () {
        $('#vendorlist').DataTable();
    } );
    </script>
</div>

</body>
</html>


    
