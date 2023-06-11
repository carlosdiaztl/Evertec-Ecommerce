<template>
  <div>
    <nav class="navbar navbar-expand-lg navbar-dark mt-3 mb-5 shadow p-2" style="background-color: #607d8b">
      <!-- Container wrapper -->
      <div class="container-fluid">
        <!-- Navbar brand -->
        <span class="navbar-brand">Categories:</span>

        <!-- Toggle button -->
        <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarSupportedContent2"
          aria-controls="navbarSupportedContent2" aria-expanded="false" aria-label="Toggle navigation">
          <i class="fas fa-bars"></i>
        </button>

        <!-- Collapsible wrapper -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent2">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <!-- Link -->

            <li class="nav-item">
              <form @submit.prevent="submitForm('all')">
                <input class="d-none" type="number" value name="category" />
                <button class="btn nav-link text-white mx-2 my-2 shadow-none" type="submit">All</button>
              </form>
            </li>
            <li v-for="category in JSON.parse(categories)" :key="category.id" class="nav-item">
              <form @submit.prevent="submitForm(category.id)">
                <input type="hidden" :value="category.id" name="category" />
                <button type="submit" class="btn nav-link text-white mx-2 my-2 shadow-none">{{ category.name }}</button>
              </form>
            </li>
          </ul>
          <!-- Search -->
          <form class="form-inline my-2 my-lg-0 d-flex" @submit.prevent="searchFormSubmit">
            <input class="form-control mr-sm-2 mx-2 form-control-sm" v-model="searchQuery" type="search" name="search"
              placeholder="Search" aria-label="Search" />
            <button class="btn btn-outline text-white my-2 my-sm-0" type="submit">Search</button>
          </form>
        </div>
      </div>
      <!-- Container wrapper -->
    </nav>
    <div class="container text-center">
      <div class="row">
        <div class="col-lg-3 col-md-6 mb-4" v-for="item in items" :key="item.id">
          <div class="card w-100 h-100">
            <div class="bg-image hover-zoom ripple ripple-surface ripple-surface-light" data-mdb-ripple-color="light">
              <img class="w-100" :src="getImage(item.image)" />
              <span>
                <div class="mask">
                  <div class="d-flex justify-content-start align-items-end h-100">
                    <h5>
                      <span class="badge bg-dark ms-2">NEW</span>
                    </h5>
                  </div>
                </div>
                <div class="hover-overlay">
                  <div class="mask" style="
                        background-color: rgba(
                            251,
                            251,
                            251,
                            0.15
                        );
                    "></div>
                </div>
                {{ item.category.name}}
              </span>
            </div>
            <div class="card-body">
              <span class="text-reset">
                <h5 class="card-title mb-2">{{ item.title  }}</h5>
              </span>
              <h6 class="price">$ {{  formatPrice(item.price) }}</h6>
            </div>
            <div class="card-footer bg-white border-0 text-150">
              <button v-if="authenticated" @click="addCart(item)" class="btn btn-success btn-sm mb-3">
                Add
                <i class="fas fa-cart-plus"></i>
              </button>
            </div>
          </div>
        </div>
      </div>

      <nav class="d-flex justify-items-center justify-content-center">
        <ul class="pagination center">
          <li class="page-item">
            <span class="page-link" :class="hasPrevPage ? 'active' : ''"
              @click="hasPrevPage ? fetchPage(prevPageUrl) : null">Anterior</span>
          </li>
          <li class="page-item active">
            <span class="page-link">{{ currentPage }}</span>
          </li>
          <li class="page-item">
            <span class="page-link" :class="hasNextPage ? 'active' : ''"
              @click="hasNextPage ? fetchPage(nextPageUrl) : null">Siguiente</span>
          </li>
        </ul>
      </nav>
      <div class="col-12">
        <button type="button" class="btn btn-success sticky-bottom mb-5 w-50" data-bs-toggle="modal"
          data-bs-target="#onboardImageModal" v-if="tieneElementos && authenticated">
          <i class="fas fa-shopping-cart"></i>
        </button>
      </div>
      <div class="modal-onboarding modal fade animate__animated" id="onboardImageModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content text-center">
            <div class="modal-header border-0">
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
              <div class="onboarding-content mb-0">
                <h4>Tu lista</h4>

                <div class="card h-100">
                  <div class="card-header d-flex justify-content-between">
                    <div class="card-title m-0 me-2">
                      <h5 class="m-0 me-2">Popular Products</h5>
                      <small class="text-muted">Total 10.4k Visitors</small>
                    </div>
                  </div>
                  <div class="card-body">
                    <ul class="p-0 m-0" v-for="(
                                                product, index
                                            ) in uniqueProducts" :key="index">
                      <li class="d-flex mb-4 pb-1">
                        <div class="me-3">
                          <img :src="getImage(
                            product.image
                          )
                            " alt="User" class="rounded" width="46" />
                        </div>
                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                          <div class="me-2">
                            <h6 class="mb-0">{{ product.title }}</h6>
                            <small class="text-muted d-block">
                              Item:
                              #FXZ-4567
                            </small>
                          </div>
                          <div class="d-flex">
                            <p class="fw-semibold">${{ product.price }}</p>
                            <h class="fw-semibold mx-2">
                              Cantidad:
                              {{
                                product.cantidad
                              }}
                            </h>
                            <button @click="
                            eliminarElementoCarrito(
                              product.id
                            )
                              " class="btn btn-danger">
                              -1
                              <i class="far fa-trash-alt"></i>
                            </button>
                          </div>
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer border-0">
              <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" @click="createCart" class="btn btn-success">Confirmar orden</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import swal from "sweetalert2";

export default {
  data() {
    return {
      items: [],
      currentPage: 1,
      prevPageUrl: "",
      nextPageUrl: "",
      hasPrevPage: false,
      hasNextPage: false,
      carrito: [],
      carritoReduced: [],
      categories: []
    };
  },
  props: {
    authenticated: {
      type: Number,
      required: true
    },
    categories: {
      type: Array,
      required: true
    }
  },
  mounted() {
    this.fetchPage(
      window.location.href.substring(
        0,
        window.location.href.indexOf("public/") + 7
      ) + "api/products"
    );
    this.carrito = JSON.parse(localStorage.getItem("carrito"))
      ? JSON.parse(localStorage.getItem("carrito"))
      : [];
  },
  methods: {
    fetchPage(url) {
      axios
        .get(url)
        .then(response => {
          this.items = response.data.data;
          this.currentPage = response.data.current_page;
          this.prevPageUrl = response.data.prev_page_url;
          this.nextPageUrl = response.data.next_page_url;
          this.hasPrevPage = !!response.data.prev_page_url;
          this.hasNextPage = !!response.data.next_page_url;
          console.log(response.data);
        })
        .catch(error => {
          console.error(error);
        });
    },
    
    submitForm(categoryId) {
      const urlcategory =
        window.location.href.substring(
          0,
          window.location.href.indexOf("public/") + 7
        ) + `api/products?category=${categoryId}`;
      const urlAll =
        window.location.href.substring(
          0,
          window.location.href.indexOf("public/") + 7
        ) + `api/products`;
      categoryId == "all"
        ? this.fetchPage(urlAll)
        : this.fetchPage(urlcategory);
    },
    searchFormSubmit() {
      const url =window.location.href.substring(
          0,
          window.location.href.indexOf("public/") + 7
        ) +`api/products?search=${encodeURIComponent(this.searchQuery)}`;
      this.fetchPage(url);
    },
    addCart(item) {
      // Obtén el array actual del localStorage
      // Crea un nuevo objeto y añádelo al array
      this.carrito.push(item);
      // Almacena el array actualizado en el localStorage
      localStorage.setItem("carrito", JSON.stringify(this.carrito));
      console.log(this.carrito);
      console.log(this.authenticated);
    },

    getImage(rutaProducto) {
      const baseUrl = window.location.href.substring(
        0,
        window.location.href.indexOf("public/") + 7
      );
      return baseUrl + rutaProducto;
    },
    eliminarElementoCarrito(id) {
      // Busca el índice del elemento con el ID especificado en el carrito
      const index = this.carrito.findIndex(producto => producto.id === id);

      this.carrito.splice(index, 1); // Elimina el elemento del array en la posición index

      // Actualiza el localStorage con el carrito actualizado
      localStorage.setItem("carrito", JSON.stringify(this.carrito));
    },
    formatPrice(price) {
    const options = {
      minimumFractionDigits: 0,
      maximumFractionDigits: 0,
    };
    return price.toLocaleString('es-ES', options);
  },
  },
  computed: {
    tieneElementos() {
      return this.carrito && this.carrito.length > 0;
    },
    uniqueProducts() {
      this.carritoReduced = Object.values(
        this.carrito.reduce((groups, product) => {
          const productId = product.id;
          const existingProduct = groups.find(item => item.id === productId);
          if (!existingProduct) {
            groups.push({
              ...product,
              cantidad: 1 // Agregar campo cantidad
            });
          } else {
            existingProduct.cantidad++; // Incrementar cantidad
          }
          return groups;
        }, [])
      );
      return this.carritoReduced;
    },
    createCart() {
      const total = this.carritoReduced.reduce(
        (sum, product) => sum + product.price * product.cantidad,
        0
      );
      const order = {
        ...this.carritoReduced,
        total: total, // Agregar la suma total
        user_id: this.authenticated, // Agregar el ID del cliente
        status: "unconfirmed"
      };
      console.log(this.carritoReduced);
      console.log(order);
      axios
        .post(
          window.location.href.substring(
            0,
            window.location.href.indexOf("public/") + 7
          ) + "api/orders",
          order
        )
        .then(response => {
          // Lógica adicional cuando la petición es exitosa

          Swal.fire("Good job!", response.data.message, "success");
          console.log(response.data);
        })
        .catch(error => {
          // Manejo de errores cuando la petición falla
          console.error(error);
        });
      // Aquí puedes realizar la lógica adicional para crear la orden con el objeto `order`
    }
  }
};
</script>
