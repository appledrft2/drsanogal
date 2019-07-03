<!doctype html>

<html lang="en">

  <head>

    <!-- Required meta tags -->

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="icon" type="image/x-icon" href="{{asset('adminlte3/dist/img/logo.jpg')}}">


    <!-- Bootstrap CSS -->

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">



    <title>Dr S & J Veterinary Clinic and Grooming Centre</title>

  </head>

  <body>

    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-0 bg-white border-bottom box-shadow">

      <h5 class="my-0 mr-md-auto font-weight-normal"><a href="/" class="text-dark lead" style="text-decoration:none"><img src="{{asset('adminlte3/dist/img/logo.jpg')}}" al="logo" width="5%" style="border-radius:90%"> Dr S & J Veterinary Clinic and Grooming Centre</a></h5>

      <nav class="my-2 my-md-0 mr-md-3 lead">

        <a style="text-decoration:none" class="p-2 text-dark" href="#home">Home</a>

        <a style="text-decoration:none" class="p-2 text-dark" href="#about">About</a>

        <a style="text-decoration:none" class="p-2 text-dark" href="#contact">Contact</a>

      </nav>
      @guest
      <a class="btn btn-outline-primary lead" href="/login">Sign in</a>
      @else
      <a class="btn btn-outline-primary lead" href="/dashboard">Dashboard</a>
      @endguest
    </div>

    <!-- END NAVBAR -->

    <!-- MAIN -->

    <div class="jumbotron " id="home" style="padding-top: 200px;padding-bottom: 300px;background-image: url('https://www.covermewithcare.com/images/index_page_bg.png');background-size:contain ">

    

      <h1 class="display-4">Welcome to our website!</h1>

      <p class="lead">We offer excellent products and services for your lovely pets.</p>

    

  </div>



    <div class="container-fluid" id="about">

      <div class="row">

        <div class="col-md-12" style="padding-top: 200px;padding-bottom: 300px">

          <div class="col-md-10 mx-auto mb-5">

            <h1 class="display-4 text-center mb-3">About Us</h1>

          <p class="text-justify lead">

            We have come together as a staff to decide why and how we do what we do.  When taking care of our clients and patients we are guided by this vision which is further defined by our clinic’s core values, our mission and our philosophies.   We then use these as a guide to help us better in our daily interactions.

          </p>

          </div>

        </div>


        </div>

      </div>

      <div class="container-fluid">

        <div class="row">

          <div class="col-md-12" style="padding-top: 200px;padding-bottom: 300px">

            <div class="col-md-10 mx-auto mb-5">

              <h1 class="display-4 text-center mb-3">Announcements</h1>

              @if(count($announcements))
                @foreach($announcements as $announcement)
                <div class="col-md-12 mb-3">
                  <div class="card">
                    <div class="card-body">
                      <h3 class="lead display-4">{{$announcement->title}}</h3>
                      <span><strong>Author:</strong> {{$announcement->user->name}}</span>
                      <p><strong>Posted at: </strong>{{$announcement->created_at}} - {{$announcement->created_at->diffForhumans()}}</p>
                      
                      <!-- <div class="form-group"><center><img src="https://c881f0228c97d2dff415-fe3700e5b950a119c046fc4abfc0711c.ssl.cf2.rackcdn.com/2012/12/bg-pets.jpg" class="img-fluid rounded"></center></div> -->
                      <p class="brand-text text-justify">
                      {!!$announcement->body !!}
                      </p>
                    </div>
                  </div>
                </div>
                @endforeach
                @else
                <div class="col-md-12 mb-3">
                  <div class="card">
                    <div class="card-body">
                      <h3 class="lead text-center">There are no announcements.</h3>
                    </div>
                  </div>
                </div>
              @endif

              <div class="float-right">{{ $announcements->appends(Request::all())->links() }}</div>

   

            </div>

          </div>


          </div>

        </div>

    </div>



     <!-- FOOTER -->

    <footer class="pt-4 my-md-5 pt-md-5 border-top" id="contact">

    <div class="row">

        <div class="col-12 col-md ml-5">

          <img class="mb-2" src="{{asset('adminlte3/dist/img/logo.jpg')}}" alt="" width="100" height="100">

          <small class="d-block mb-3 text-muted">&copy; 2019-2020</small>

        </div>

      <div class="col-6 col-md">

        <h5>Contact Us</h5>

        <ul class="list-unstyled text-small">

          <li><a class="text-muted" href="#"><b>Tel:</b></a></li>

          <li><a class="text-muted" href="#">122 435 (3211)</a></li>

          <li><a class="text-muted" href="#"><b>Globe:</b></a></li>

          <li><a class="text-muted" href="#">09151535150</a></li>

          <li><a class="text-muted" href="#"><b>Smart</b></a></li>

          <li><a class="text-muted" href="#">09578458465</a></li>

        </ul>

      </div>

      <div class="col-6 col-md">

        <h5>Address</h5>

        <ul class="list-unstyled text-small">

          <li><a class="text-muted" href="#">Door 2, Garces Bldg</a></li>

          <li><a class="text-muted" href="#">Alijis Road, Brgy Alijis</a></li>

          <li><a class="text-muted" href="#">Bacolod City 6100</a></li>

          <li><a class="text-muted" href="#">Negros Occidental</a></li>

        </ul>

      </div>

      <div class="col-6 col-md">

      <br><br><br><br>

      <a href="#" class="">Back to top</a>

    

      </div>

    </div>

  </footer>

    

    <!-- Optional JavaScript -->

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script type="text/javascript">
        window.onload = () => {
         let bannerNode = document.querySelector('[alt="www.000webhost.com"]').parentNode.parentNode;
         bannerNode.parentNode.removeChild(bannerNode);
        }
    </script>

  </body>

</html>

