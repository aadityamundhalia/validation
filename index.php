<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <title>jQuery form validation</title>
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.3/css/bootstrapValidator.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-flexdatalist/2.2.2/jquery.flexdatalist.min.css"/>
  </head>
  <body>
    <h1 align="center">jQuery Validation Form</h1>
    <form id="contactForm" method="post" class="form-horizontal" action="Processing.php">
        <div class="form-group">
            <label class="col-md-3 control-label">Name</label>
            <div class="col-md-6">
                <input type="text" class="form-control" name="name" placeholder="Name" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">Email</label>
            <div class="col-md-6">
                <input type="text" class="form-control" name="email" placeholder="Email" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">Phone</label>
            <div class="col-md-6">
                <input type="text" class="form-control" name="phone" placeholder="Phone" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">Business name</label>
            <div class="col-md-6">
                <input type="text" class="form-control" name="businessName" placeholder='Business Name' />
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">Suburb</label>
            <div class="col-md-6">
              <input placeholder='Write your suburb name' class="form-control" id="flexdatalist" name='suburb' type='text'>
            </div>
        </div>
        <!-- #messages is where the messages are placed inside -->
        <div class="form-group">
            <div class="col-md-9 col-md-offset-3">
                <div id="messages"></div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-9 col-md-offset-3">
                <button type="submit" class="btn btn-default">Validate</button>
            </div>
        </div>
    </form>

    <script type="text/javascript" src="http://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.3/js/bootstrapValidator.min.js"> </script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-flexdatalist/2.2.2/jquery.flexdatalist.min.js"> </script>
    <script>
    $(document).ready(function() {
        $('#contactForm').bootstrapValidator({
            container: '#messages',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                name: {
                    validators: {
                        notEmpty: {
                            message: 'The name field is required and cannot be empty'
                        }
                    }
                },
                email: {
                    validators: {
                        notEmpty: {
                            message: 'The email address is required and cannot be empty'
                        },
                        emailAddress: {
                            message: 'The email address is not valid'
                        }
                    }
                },
                suburb: {
                    validators: {
                        notEmpty: {
                            message: 'The suburb field is required and cannot be empty'
                        }
                    }
                }
            }
        });
        $('#flexdatalist').flexdatalist({
             minLength: 1,
             textProperty: '{postcode}, {suburb}, {state}',
             valueProperty: 'id',
             selectionRequired: true,
             visibleProperties: ["suburb","postcode","state"],
             searchIn: 'suburb',
             data: 'http://mundhalia.club/json.php'
        });
    });
    </script>
  </body>
</html>
