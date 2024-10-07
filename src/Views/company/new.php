<div class="container text-center mt-5 pt-2">

    <div class="title mb-3">
        <h1 class="pageTitle fw-bold">Nouvelle entreprise</h1>
    </div>

    <form action="" method="POST" class="border border-secondary border-5 rounded-3 d-flex justify-content-evenly align-items-center" enctype="multipart/form-data">

        <fieldset class="w-50 row mb-3 ">
            <div class="form-group w-50 mb-3 w-100 pt-1 border border-1 border-secondary border-opacity-10 rounded-3">
                <picture class="" style="width: 250px; height:250px">
                    <source srcset="..." type="image">
                    <label for="companyLogo" style="cursor: pointer;" class="">
                        <img src="<?= $avatar ?>" alt="company logo ..." id="imagePreview" width="100" height="100" class="img-thumbnail" style="display: <?= $full_path_img ? 'block' : 'none' ?>"><br>
                    </label>
                </picture>
                <input class="d-none" type="file" id="companyLogo" name="companyLogo" accept="image/*" required onchange="previewImage(event)" />
            </div>
            <div class="form-grou[ mb-3">
                <input type="text" name="nom" class="form-control" placeholder="Nom entreprise...">
            </div>
            <div class="form-grou[ mb-3">
                <input type="text" name="siege" class="form-control" placeholder="Siege social...">
            </div>
            <div class="form-grou[ mb-3">
                <input type="email" name="email" class="form-control" placeholder="Adresse Email...">
            </div>
            <div class="form-grou[ mb-3">
                <input type="password" name="password" class="form-control" placeholder="Password...">
            </div>
            <button type="submit" class="btn btn-primary fw-bold rounded-3 d-block float-right border border-none">Enregistrer</button>
        </fieldset>

        <div>
            <p class="my-0">Avez-vous déjà une entreprise ? </p>
            <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Ajouter une Election</a>
        </div>
    </form>
</div>