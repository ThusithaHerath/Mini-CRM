<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Add Employee</title>
</head>
<body>
    <!--Main Navigation-->
<header>
    <!-- Sidebar -->
    <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
      <div class="position-sticky">
        <div class="list-group list-group-flush mx-3 mt-4">
          <a
            href="#"
            class="list-group-item list-group-item-action py-2 ripple active"
            aria-current="true"
          >
            <i class="fas fa-tachometer-alt fa-fw me-3"></i><span>Main dashboard</span>
          </a>
          <a href="{{url('manage-companies')}}" class="list-group-item list-group-item-action py-2 ripple"
          ><i class="fa-solid fa-building fa-fw me-3"></i><span>Manage Companies</span></a>

        <a href="{{url('manage-employee')}}" class="list-group-item list-group-item-action py-2 ripple"
        ><i class="fa-solid fa-people-line fa-fw me-3"></i><span>Manage Employees</span></a>
  

  
  
        </div>
      </div>
    </nav>
    <!-- Sidebar -->
  
    <!-- Navbar -->
    <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
      <!-- Container wrapper -->
      <div class="container-fluid">
        <!-- Toggle button -->
        <button
          class="navbar-toggler"
          type="button"
          data-mdb-toggle="collapse"
          data-mdb-target="#sidebarMenu"
          aria-controls="sidebarMenu"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <i class="fas fa-bars"></i>
        </button>
  
        <!-- Brand -->
        <a class="navbar-brand" href="#">
          <img
            src="/images/logo.png"
            height="50"
            style="padding-left:90px;"
          />
        </a>
        <!-- Search form -->

  
        <!-- Right links -->
        <ul class="navbar-nav ms-auto d-flex flex-row">
           <a href="{{ route('logout') }}"onclick="event.preventDefault();  document.getElementById('logout-form').submit();"  class="btn btn-primary dark-btn-primary" href="sign-in.html" role="button"> <i class="fa-solid fa-power-off"></i> <span>{{ Auth::user()->name }}</span></a> 
           <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
               @csrf
           </form>
        </ul>
      </div>
      <!-- Container wrapper -->
    </nav>
    <!-- Navbar -->
  </header>
  <!--Main Navigation-->
  
  <!--Main layout-->
  <main class="main-body" style="margin-top: 58px; margin-left: 70px;  ">
    <form action="{{url('store-employee')}}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
          <label for="exampleInputEmail1">First Name</label>
          <input type="text" name="fname" class="form-control"  placeholder="Enter first name" required>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Last Name</label>
            <input type="text" name="lname" class="form-control"  placeholder="Enter last name" required>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Company</label>
            <select name="company" class="form-control">
                <option selected>Select Company</option>
                @foreach ($company as $item)
                <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
              </select>
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Email</label>
          <input type="email" name="email" class="form-control"  placeholder="Enter email" >
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Phone</label>
            <input type="number" name="phone" class="form-control" id="exampleInputPassword1" placeholder="Enter phone number" maxlength="10"  >
          </div>
          <div style="padding-top: 20px;">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{url('manage-employee')}}" class="btn btn-danger">Cancel</a>
          </div>
      </form>
  </main>
  <!--Main layout-->
  <style>
      body {
  background-color: #fbfbfb;
}

@media (min-width: 991.98px) {
  main {
    padding-left: 240px;
  }
}
.main-body{
  padding-right: 50px;
}
/* Sidebar */
.sidebar {
  position: fixed;
  top: 0;
  bottom: 0;
  left: 0;
  padding: 58px 0 0; /* Height of navbar */
  box-shadow: 0 2px 5px 0 rgb(0 0 0 / 5%), 0 2px 10px 0 rgb(0 0 0 / 5%);
  width: 260px;
  z-index: 600;
}

@media (max-width: 991.98px) {
  .sidebar {
    width: 100%;
  }
}
.sidebar .active {
  border-radius: 5px;
  box-shadow: 0 2px 5px 0 rgb(0 0 0 / 16%), 0 2px 10px 0 rgb(0 0 0 / 12%);
}

.sidebar-sticky {
  position: relative;
  top: 0;
  height: calc(100vh - 48px);
  padding-top: 0.5rem;
  overflow-x: hidden;
  overflow-y: auto; /* Scrollable contents if viewport is shorter than content. */
}
  </style>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script>
      // Graph
var ctx = document.getElementById("myChart");

var myChart = new Chart(ctx, {
  type: "line",
  data: {
    labels: [
      "Sunday",
      "Monday",
      "Tuesday",
      "Wednesday",
      "Thursday",
      "Friday",
      "Saturday",
    ],
    datasets: [
      {
        data: [15339, 21345, 18483, 24003, 23489, 24092, 12034],
        lineTension: 0,
        backgroundColor: "transparent",
        borderColor: "#007bff",
        borderWidth: 4,
        pointBackgroundColor: "#007bff",
      },
    ],
  },
  options: {
    scales: {
      yAxes: [
        {
          ticks: {
            beginAtZero: false,
          },
        },
      ],
    },
    legend: {
      display: false,
    },
  },
});
  </script>
  
</body>
</html>