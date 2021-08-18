<header>
   <div class="container-fluid">
      <div class="row ml-0 justify-content-between">
         <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
               <span class="navbar-toggler-icon"></span>
            </button>
            <div class="col collapse navbar-collapse" id="navbarNav">
               <a class="navbar-brand" href="/admin">Admin</a>
               <ul class="navbar-nav">
                     <li class="nav-item">
                        <a class="nav-link" href="/user/create">Create new User</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" href="/education/create">Create new Education</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" href="/job/create">Create new Job</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" href="/skill/create">Create new Skill</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" href="/hobby/create">Create new Hobby</a>
                     </li>
               </ul>
            </div>
            <div class="col">
                <ul class="navbar-nav">
                     <li class="nav-item">
                        <a class="nav-link" href="/user/<?= getUserIdFromSession() ?>/edit">
                           <?= getNameFromSession() ?>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" href="/logout">Logout</a>
                     </li>  
               </ul>
            </div>
         </div>
      </nav>
   </div>
</header>