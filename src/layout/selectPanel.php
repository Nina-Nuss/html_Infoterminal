<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
<div id="selectPanel">
    <div class="col-md-12 mx-auto pl-auto bg-gray-100 d-flex align-items-center justify-content-center p-0">
        <div class="d-flex position-relative w-100 align-items-center">
            <div class="d-flex justify-content-center gap-2 w-100" id="startBtns">
                <button type="button" id="infotherminalBereich" data-bs-toggle="dropdown" aria-expanded="false"
                    class="btn text-dark start-btn dropdown-toggle"
                    style="background-color: rgba(255, 255, 255, 0.952); border-color: #006b99; border-radius: 8px;">Infoterminal</button>
                <button id="templates" type="button" class="btn text-dark start-btn"
                    style="border-color: #006b99; border-radius: 8px; background-color: rgba(255, 255, 255, 0.952);">Templates</button>
                <button id="adminBereich" type="button" class="btn text-dark start-btn"
                    style="border-color: #006b99; border-radius: 8px; background-color: rgba(255, 255, 255, 0.952);">Administration</button>
            </div>
            <div class="d-flex align-items-center justify-content-center position-absolute ms-auto end-0 me-4">

                <div>Eingeloggt als: <span id="usernameDisplay"><?php if(isset($_SESSION['username'])){ echo $_SESSION['username']; } if(isset($_COOKIE['username'])){ echo $_COOKIE['username']; } ?></span></div>
                <button id="logout" type="button" onclick="logout()" class="btn text-dark start-btn "
                    style="width: 40px; border-color: #006b99; border-radius: 8px; background-color: rgba(255, 255, 255, 0.952);"
                    aria-label="Logout" title="Logout">
                    <i class="bi bi-box-arrow-right"></i>
                </button>

            </div>

        </div>
    </div>
</div>