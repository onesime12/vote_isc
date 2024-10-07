<div class="row gx-2 container-fluid p-0 m-0 bg-red">
    <div class="col accueil p-0 position-relative vh-100">
        <div class="bg-dark bg-opacity-50 my-0 h-100 d-flex flex-column align-items-center justify-content-center position-fixed text-center text-white">
            <h3 class="fw-bold">Bienvenu à tous !</h3>
            <p class="fw-bold my-5" style="width: 663px;">Prenons un temps radieux pour bénéficier des merveils que vous offre notre plate forme d'organisation de votes électroniques</p>
            <div>
                <p class="my-0">Avez-vous déjà visité notre site ?? </p>
                <button class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#login" data-bs-whatever="@mdo">Connexion</button>
            </div>
        </div>



    </div>
    <div class="col text-justify px-2 min-vh-50 mt-5">
        <h1 class="fw-bold p-3 fs-4">Vos entreprises</h1>
        <form action="">
            <div class="form-group p-2">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Recherche une entreprise...">
                    <button type="button" class="btn btn-outline-secondary">Search</button>
                </div>
            </div>
        </form>
        <table class="table table-striped rounded-3">
            <thead>
                <tr>
                    <th scope="col">Logo</th>
                    <th scope="col">Nomination</th>
                    <th scope="col">Siège social</th>
                    <th scope="col">Password</th>
                    <th scope="col" class="d-flex align-items-center justify-content-around">
                        <div class="h-100">Actions</div>
                        <?php if (!isset($_SESSION["is_logged_in"])) : ?>
                            <a class="p-1 rounded-3" style="background-color: black;" href="/new-company">+ new</a>
                        <?php endif ?>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($company as $key => $value) : ?>
                    <tr class="">
                        <td scope="col" class=""><img src="<?= $value->getLogo() ?>" alt="logo..." width="35" height="35" class="rounded-circle mb-0"></td>
                        <td scope="col" class=""><?= $value->getEmail() ?></td>
                        <td scope="col" class=""><?= $value->getSiege() ?> </td>
                        <td scope="col" class=""><?= $value->getPassword() ?> </td>
                        <td scope="col" class="">
                            <a href="/show-company-<?= $value->getId() ?>" class="btn btn-success btn-sm d-block w-100 px-0">See more...</a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
            <tfoot></tfoot>
        </table>
        <div class="dropdown me-3 bd-mode-toggle">
            <button class="btn btn-bd-primary py-2 dropdown-toggle d-flex align-items-center"
                id="bd-theme"
                type="button"
                aria-expanded="false"
                data-bs-toggle="dropdown"
                aria-label="Toggle theme (auto)">
                <svg class="bi my-1 theme-icon-active" width="1em" height="1em">
                    <use href="#circle-half"></use>
                </svg>
                <span class="" id="bd-theme-text">Toggle theme</span>
            </button>
            <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="bd-theme-text">
                <li>
                    <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="light" aria-pressed="false">
                        <svg class="bi me-2 opacity-100" width="1em" height="1em">
                            <use href="#sun-fill"></use>
                        </svg>
                        Light
                        <svg class="bi ms-auto" width="1em" height="1em">
                            <use href="#check2"></use>
                        </svg>
                    </button>
                </li>
                <li>
                    <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="dark" aria-pressed="false">
                        <svg class="bi me-2 opacity-100" width="1em" height="1em">
                            <use href="#moon-stars-fill"></use>
                        </svg>
                        Dark
                        <svg class="bi ms-auto" width="1em" height="1em">
                            <use href="#check2"></use>
                        </svg>
                    </button>
                </li>
                <li>
                    <button type="button" class="dropdown-item d-flex align-items-center active" data-bs-theme-value="auto" aria-pressed="true">
                        <svg class="bi me-2 opacity-100" width="1em" height="1em">
                            <use href="#circle-half"></use>
                        </svg>
                        Auto
                        <svg class="bi ms-auto " width="1em" height="1em">
                            <use href="#check2"></use>
                        </svg>
                    </button>
                </li>
            </ul>
        </div>
    </div>

</div>