<header>
   <div class="container-fluid">
      <div class="row ml-0 justify-content-between">
         <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
               <span class="navbar-toggler-icon"></span>
            </button>
            <div class="col collapse navbar-collapse" id="navbarNav">
               <a class="navbar-brand" href="/">CV</a>
               <?php if (isLoggedIn()) : ?>
               <ul class="navbar-nav">
                     <li class="nav-item">
                        <a class="nav-link" href="/profile/<?= getUserIdFromSession() ?>">Profile</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" href="/user/<?= getUserIdFromSession() ?>">Personal info</a> 
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" href="/education">Educations</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" href="/job">Jobs</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" href="/skill">Skills</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" href="/hobby">Hobbies</a>
                     </li>
               </ul>
               <?php endif ?>
            </div>
            <div class="col">
                <ul class="navbar-nav">
                  <?php if (isLoggedIn()) : ?>
                     <li class="nav-item">
                        <a class="nav-link" href="/user/<?= getUserIdFromSession() ?>/edit">
                           <?= getNameFromSession() ?>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" href="/logout">Logout</a>
                     </li>
                  <?php else : ?>
                     <li class="nav-item">
                        <a class="nav-link" href="/login">Login</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" href="/register">Register</a>
                     </li>
                  <?php endif ?>
                   
               </ul>
            </div>
         </div>
      </nav>
   </div>
</header>