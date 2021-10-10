<template>
  <div class="container-fluid">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Logo</a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <router-link
                class="nav-link active"
                exact
                :to="{ name: 'index' }"
              >
                Home
              </router-link>
            </li>
            <li class="nav-item">
              <router-link class="nav-link" exact :to="{ name: 'register' }">
                Ingresa Aquí
              </router-link>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <div
      id="carouselExampleCaptions"
      class="carousel slide border"
      data-bs-ride="carousel"
    >
      <div class="carousel-indicators">
        <button
          type="button"
          data-bs-target="#carouselExampleCaptions"
          data-bs-slide-to="0"
          class="active"
          aria-current="true"
          aria-label="Slide 1"
        ></button>
        <button
          type="button"
          data-bs-target="#carouselExampleCaptions"
          data-bs-slide-to="1"
          aria-label="Slide 2"
        ></button>
        <button
          type="button"
          data-bs-target="#carouselExampleCaptions"
          data-bs-slide-to="2"
          aria-label="Slide 3"
        ></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <!--<img src="..." class="d-block w-100" alt="...">-->
          <div class="carousel-caption d-none d-md-block">
            <h5>First slide label</h5>
            <p>Some representative placeholder content for the first slide.</p>
          </div>
        </div>
        <div class="carousel-item">
          <!--<img src="..." class="d-block w-100" alt="...">-->
          <div class="carousel-caption d-none d-md-block">
            <h5>Second slide label</h5>
            <p>Some representative placeholder content for the second slide.</p>
          </div>
        </div>
        <div class="carousel-item">
          <!--<img src="..." class="d-block w-100" alt="...">-->
          <div class="carousel-caption d-none d-md-block">
            <h5>Third slide label</h5>
            <p>Some representative placeholder content for the third slide.</p>
          </div>
        </div>
      </div>
      <button
        class="carousel-control-prev"
        type="button"
        data-bs-target="#carouselExampleCaptions"
        data-bs-slide="prev"
      >
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button
        class="carousel-control-next"
        type="button"
        data-bs-target="#carouselExampleCaptions"
        data-bs-slide="next"
      >
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
    <div id="ribbon" class="container-fluid">
      <div id="slide" class="container w-50 px-5 rounded-lg">
        <div class="row align-items-center">
          <div>
            <img class="w-75 mx-auto d-block" />
          </div>
          <div class="col-sm p-3 text-center">
            <h4>Facturación Siigo</h4>
          </div>
        </div>
      </div>
    </div>
    <div class="separator-ribbon">
      <div class="content bg-primary"></div>
    </div>
    <div id="seccion">
      <div class="container-md p-5">
        <div class="row pt-5">
          <h3 class="text-center py-5">Servicios</h3>
        </div>
        <div class="row">
          <div class="col-sm">
            <div class="card w-100 card-border mb-5">
              <img class="card-img-top" alt="..." />
              <div class="card-body">
                <h5 class="card-title">Compras</h5>
                <p class="card-text">
                  Some quick example text to build on the card title and make up
                  the bulk of the card's content.
                </p>
              </div>
            </div>
          </div>
          <div class="col-sm">
            <div class="card w-100 card-border mb-5">
              <img class="card-img-top" alt="..." />
              <div class="card-body">
                <h5 class="card-title">Ventas</h5>
                <p class="card-text">
                  Some quick example text to build on the card title and make up
                  the bulk of the card's content.
                </p>
              </div>
            </div>
          </div>
          <div class="col-sm">
            <div class="card w-100 card-border mb-5">
              <img class="card-img-top" alt="..." />
              <div class="card-body">
                <h5 class="card-title">Proveedores</h5>
                <p class="card-text">
                  Some quick example text to build on the card title and make up
                  the bulk of the card's content.
                </p>
              </div>
            </div>
          </div>
        </div>
        <div id="footer" class="p-5">
          <div class="container w-50 pt-5">
            <div class="row row-cols-md-2 justify-content-md-center">
              <div class="col text-center">
                <a>
                  <button class="btn bnt-lg btn-primary rounded-pill w-100 shadow-sm fw-bold p-3">Encuentranos</button>
                </a>
              </div>
            </div>
            <div class="row justify-content-md-center py-4">
                <div class="col text-center">
                    <p>Empresa de facturación nacional</p>
                    <p>Telefóno: 456 34 23 </p>
                    <p>Ubicanos: Calle 26 # 57 -39 Bogotá, Colombia</p>
                    <p>@ 2021 Facturación Siigo</p>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
	
};
</script>