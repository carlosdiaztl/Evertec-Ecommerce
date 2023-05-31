<template>
  <div class="text-center">
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
              {{ item.title }}
            </span>
          </div>
          <div class="card-body">
            <span class="text-reset">
              <h5 class="card-title mb-2">{{ item.title }}</h5>
            </span>
            <h6 class="price">{{ item.price }}$</h6>
          </div>
          <div class="card-footer bg-white border-0 text-150">
            <button v-if="authenticated"  @click="addCart(item)" class="btn btn-success btn-sm mb-3">
              Agregar<i class="fas fa-cart-plus"></i>
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
          <span class="page-link">{{ currentPage }} </span>
        </li>
        <li class="page-item">
          <span class="page-link" :class="hasNextPage ? 'active' : ''"
            @click="hasNextPage ? fetchPage(nextPageUrl) : null">Siguiente</span>
        </li>
      </ul>
    </nav>
    <div class="col-12">

      <button type="button" class="btn btn-success sticky-bottom mb-5 w-50"   data-bs-toggle="modal" data-bs-target="#onboardImageModal"
        v-if="tieneElementos && authenticated"  >
        <i class="fas fa-shopping-cart "></i>
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
                    <h5 class="m-0 me-2">
                      Popular Products
                    </h5>
                    <small class="text-muted">Total 10.4k Visitors</small>
                  </div>
                </div>
                <div class="card-body">
                  <ul class="p-0 m-0" v-for="product in this.carrito" :key="product.id">
                    <li class="d-flex mb-4 pb-1">
                      <div class="me-3">
                        <img :src="getImage(product.image)
                          " alt="User" class="rounded" width="46" />
                      </div>
                      <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                        <div class="me-2">
                          <h6 class="mb-0">
                            {{ product.title }}
                          </h6>
                          <small class="text-muted d-block">Item: #FXZ-4567</small>
                        </div>
                        <div class="user-progress d-flex align-items-center gap-1 ">
                          <p class="mb-0 fw-semibold">
                            ${{ product.price }}
                          </p>
                          <button @click="eliminarElementoCarrito(product.id)" class="btn btn-danger mx-2" ><i class="far fa-trash-alt"></i> </button>
                        </div>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer border-0">
            <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
              Close
            </button>
            <button type="button" class="btn btn-primary">
              Submit
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

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
    };
  },
  props: {
    authenticated: {
            type:Number,
            required: true,
        },
        
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
      axios.get(url)
        .then((response) => {
          this.items = response.data.data;
          this.currentPage = response.data.current_page;
          this.prevPageUrl = response.data.prev_page_url;
          this.nextPageUrl = response.data.next_page_url;
          this.hasPrevPage = !!response.data.prev_page_url;
          this.hasNextPage = !!response.data.next_page_url;
          console.log(response.data);
        })
        .catch((error) => {
          console.error(error);
        });
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
      const index = this.carrito.findIndex(
        (producto) => producto.id === id
      );

      this.carrito.splice(index, 1); // Elimina el elemento del array en la posición index

      // Actualiza el localStorage con el carrito actualizado
      localStorage.setItem("carrito", JSON.stringify(this.carrito));
    },
  },
  computed: {
    tieneElementos() {
      return this.carrito && this.carrito.length > 0;
    },
  },
};
</script>
