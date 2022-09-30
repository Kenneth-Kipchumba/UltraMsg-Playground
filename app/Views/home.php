<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>UltraMsg</title>
  </head>
  <body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h1>Send Message</h1>
            </div>
            <div class="card-body">

                <div class="alert alert-danger" role="alert">
                 <!- report  CSRF protection errors -->
                 <?= session()->getFlashdata('error') ?>
                </div>

                <div class="alert alert-danger" role="alert">
                 <!- report form validation errors -->
                 <?= service('validation')->listErrors() ?>
                </div>

                <form action="<?= base_url('message') ?>" method="POST">
                    <?= csrf_field() ?>
                  <div class="mb-3">
                    <label for="phone_number" class="form-label">Phone Number</label>
                    <input type="text" class="form-control" id="phone_number" name="phone_number" aria-describedby="phone_number_help">
                    <div id="phone_number_help" class="form-text">Enter Phone Number To Send To in International Format.</div>
                  </div>
                  <div class="mb-3">
                    <label for="message" class="form-label">Message</label>
                    <textarea class="form-control" name="message" id="message">
                        
                    </textarea>
                  </div>

                  <button type="submit" class="btn btn-primary">Send</button>
                </form>
            </div>
        </div>
    </div>


    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>
