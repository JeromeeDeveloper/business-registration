<ul class="nav nav-secondary">
    <li class="nav-item">
      <a href="{{route('adminDashboard')}}" class="collapsed">
        <i class="fas fa-home"></i>
        <p>Dashboard</p>
      </a>
    </li>
    <!-- Other nav items -->
    <li class="nav-item">
      <a data-bs-toggle="collapse" href="#forms">
        <i class="fas fa-pen-square"></i>
        <p>Forms</p>
        <span class="caret"></span>
      </a>
      <div class="collapse" id="forms">
        <ul class="nav nav-collapse">
          <li>
            <a href="{{route('adminregister')}}">
              <span class="sub-item">Register Cooperative</span>
            </a>
          </li>
          <li>
            <a href="{{route('adminview')}}">
              <span class="sub-item">View Cooperative</span>
            </a>
          </li>
        </ul>
      </div>
    </li>
    <!-- Other nav items -->
  </ul>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      // Get all the main nav links and submenu links
      const navLinks = document.querySelectorAll('.nav-item a');
      const subMenuLinks = document.querySelectorAll('.nav-collapse a');

      // Function to handle submenu toggle and apply active class
      function setActiveClass(links) {
        links.forEach(link => {
          link.addEventListener('click', function (event) {
            const href = this.getAttribute('href');

            // If the link has a valid href (meaning it's a navigation link), don't prevent default
            if (href && href !== "#" && !href.includes('#')) {
              return; // Let the default navigation happen
            }

            // Prevent default link behavior if it's for collapsing/expanding a submenu
            event.preventDefault();

            // Remove active class from all links (including submenus)
            links.forEach(link => {
              link.classList.remove('active');
              const parentLi = link.closest('li');
              parentLi.classList.remove('active');
              const collapseDiv = parentLi.querySelector('.collapse');
              if (collapseDiv) {
                collapseDiv.classList.remove('show');
              }
            });

            // Add 'active' class to the clicked link
            this.classList.add('active');

            // Make sure the parent li gets the 'active' class
            const parentLi = this.closest('li');
            parentLi.classList.add('active');

            // Ensure the collapse is shown for the submenu
            const collapseDiv = parentLi.querySelector('.collapse');
            if (collapseDiv) {
              // Toggle the 'show' class to expand the submenu
              if (!collapseDiv.classList.contains('show')) {
                collapseDiv.classList.add('show');
              }
            }

            // If the submenu is a main link, handle collapse toggling
            const parentNavItem = this.closest('.nav-item');
            const collapsibleSubMenu = parentNavItem.querySelector('.collapse');
            if (collapsibleSubMenu && !collapsibleSubMenu.classList.contains('show')) {
              collapsibleSubMenu.classList.add('show');
            }
          });
        });
      }

      // Set active class for the main navigation links
      setActiveClass(navLinks);

      // Set active class for the submenu links
      setActiveClass(subMenuLinks);
    });
  </script>


