<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    
    <title>Manage Companies</title>
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
  <main class="main-body" style="margin-top: 58px; margin-left: 70px; ">
    <a href="{{url('add-company')}}" type="button" class="btn btn-primary" style="margin-bottom: 20px; margin-top: 20px;">Add Company</a>
    @if(Session::has('company_added'))
				
    <div class="alert alert-primary alert-dismissible fade show" role="alert">
        <strong>Success!</strong> {{session('company_added')}}
    </div>
    @endif

    @if(Session::has('deleted_company'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Success!</strong> {{session('deleted_company')}}
    </div>
    @endif

    @if(Session::has('updated_company'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> {{session('updated_company')}}
    </div>
    @endif

    <table id="myTable">
      <thead >
        <tr>
          <th scope="col">#</th>
          <th scope="col">Name</th>
          <th scope="col">Email</th>
          <th scope="col">Logo</th>
          <th scope="col">Website</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
       @foreach ($data as $item)
       <tr>
        <td>{{$item->id}}</td>
        <td>{{$item->name}}</td>
        <td>{{$item->email}}</td>
        <td><img height="100px" width="100px" src="storage/{{$item->image}}"  alt="logo"></td> 
        <td>{{$item->website}}</td>
        <td>
          <a class="btn btn-success"   href="{{url('edit-company/'.$item->id)}}"><i class="far fa-edit"></i></a> &nbsp;
          <a class="btn btn-danger" href="{{url('remove-company/'.$item->id)}}"><i class="fa fa-trash"></i></a>
        </td>
      </tr>
       @endforeach
       {{--  {{asset('storage/'.$item->image)}}--}}
      </tbody>
     
    </table>
    {{-- <div class="d-flex justify-content-center">
      {!! $data->links() !!}
    </div> --}}
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
  <script src="{{asset('js/app.js')}}"></script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
 <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
 <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script> 
 <script>
   $(document).ready( function () {
    $('#myTable').DataTable();
} );
 </script>
</body>
</html>