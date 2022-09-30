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
    <div class="container-fluid">
        <div class="row">
            <div class="col-9">
                <div class="card">
            <div class="card-header">
                <h1>Send Message</h1>
            </div>
            <div class="card-body">

                <?php if(session('error')) : ?>
                    <div class="alert alert-danger" role="alert">
                     <!- report  CSRF protection errors -->
                     <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>
                <?php if(session('msg')) : ?>
                    <div class="alert alert-warning" role="alert">
                     <!- report  CSRF protection errors -->
                     <?= session('msg') ?>
                    </div>
                <?php endif; ?>

                <div class="alert alert-danger" role="alert">
                 <!- report form validation errors -->
                 <?= service('validation')->listErrors() ?>
                </div>

                <form action="<?= base_url('message') ?>" method="POST" enctype="multipart/form-data" accept-charset="utf-16">
                <?= csrf_field() ?>
                <div class="row">
                    <div class="col">
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
                        </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="img" class="form-label">Image</label>
                            <input type="file" class="form-control" id="img" name="img" aria-describedby="image_help">
                            <div id="image_help" class="form-text">Select Image to Send.</div>
                        </div>
                    </div>
                </div>

                  <button type="submit" class="btn btn-primary">Send</button>
                </form>
            </div>
        </div>
            </div>
            <div class="col-3">
                <?php $message = '' ?>
                <ul class="list-group">
                <?php if($messages) : ?>
                    <?php foreach($messages as $message) : ?>
                    <li class="list-group-item">
                            <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#message-<?= $message['id'] ?>" aria-expanded="false" aria-controls="message-<?= $message['id'] ?>">
                                <?= $message['phone_number'] ?>
                            </button>
                    </li>
                </ul>
                <hr>
                <div class="collapse" id="message-<?= $message['id'] ?>">
                    <div class="card-body">
                        <?= $message['message'] ?>
                    </div>
                </div>
                <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>


    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>
