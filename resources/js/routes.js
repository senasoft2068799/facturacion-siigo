import Register from "./pages/Auth/Register.vue";
import Login from "./pages/Auth/Login.vue";
import Dashboard from "./pages/Dashboard.vue";
import RolesIndex from "./pages/Roles/Index.vue";
import RolesShow from "./pages/Roles/Show.vue";
import RolesCreate from "./pages/Roles/Create.vue";
import RolesEdit from "./pages/Roles/Edit.vue";
import SucursalesIndex from "./pages/Sucursales/Index.vue";
import SucursalesCreate from "./pages/Sucursales/Create.vue";
import SucursalesEdit from "./pages/Sucursales/Edit.vue";
import BodegasIndex from "./pages/Bodegas/Index.vue";
import BodegasCreate from "./pages/Bodegas/Create.vue";
import BodegasEdit from "./pages/Bodegas/Edit.vue";
import FacturasIndex from "./pages/Facturas/Index.vue";
import FacturasShow from "./pages/Facturas/Show.vue";
import FacturasCreate from "./pages/Facturas/Create.vue";
import FacturasEdit from "./pages/Facturas/Edit.vue";
import CategoriasIndex from "./pages/Categorias/Index.vue";
import CategoriasCreate from "./pages/Categorias/Create.vue";
import CategoriasEdit from "./pages/Categorias/Edit.vue";
import ProductosIndex from "./pages/Productos/Index.vue";
import ProductosCreate from "./pages/Productos/Create.vue";
import ProductosEdit from "./pages/Productos/Edit.vue";
import UsuariosIndex from "./pages/Usuarios/Index.vue";
import UsuariosEdit from "./pages/Usuarios/Edit.vue";
import UsuariosCreate from "./pages/Usuarios/Create.vue";
import StocksIndex from "./pages/Stocks/Index.vue";
import Index from "./pages/Index.vue";

export const routes = [
    //
    // Dashboard
    //
    {
        name: "register",
        path: "/register",
        component: Register,
        meta: { guest: true }
    },
    {
        name: "login",
        path: "/login",
        component: Login,
        meta: { guest: true }
    },
    {
        name: "dashboard",
        path: "/",
        component: Dashboard,
        meta: { requiresAuth: true }
    },
    //
    // Roles
    //
    {
        name: "roles.index",
        path: "/roles",
        component: RolesIndex,
        meta: { requiresAuth: true }
    },
    {
        name: "roles.show",
        path: "/roles/:id/",
        component: RolesShow,
        meta: { requiresAuth: true }
    },

    {
        name: "roles.create",
        path: "/roles/create",
        component: RolesCreate,
        meta: { requiresAuth: true }
    },

    {
        name: "roles.edit",
        path: "/roles/:id/edit",
        component: RolesEdit,
        meta: { requiresAuth: true }
    },
    //
    // Sucursales
    //
    {
        name: "sucursales.index",
        path: "/sucursales",
        component: SucursalesIndex,
        meta: { requiresAuth: true }
    },
    {
        name: "sucursales.create",
        path: "/sucursales/create",
        component: SucursalesCreate,
        meta: { requiresAuth: true }
    },
    {
        name: "sucursales.edit",
        path: "/sucursales/:id/edit",
        component: SucursalesEdit,
        meta: { requiresAuth: true }
    },
    //
    //Categorias
    //
    {
        name: "categorias.index",
        path: "/categorias",
        component: CategoriasIndex,
        meta: { requiresAuth: true }
    },
    {
        name: "categorias.create",
        path: "/categorias/create",
        component: CategoriasCreate,
        meta: { requiresAuth: true }
    },
    {
        name: "categorias.edit",
        path: "/categorias/:id/edit",
        component: CategoriasEdit,
        meta: { requiresAuth: true }
    },
    //
    //Productos
    //
    {
        name: "productos.index",
        path: "/productos",
        component: ProductosIndex,
        meta: { requiresAuth: true }
    },
    {
        name: "productos.create",
        path: "/productos/create",
        component: ProductosCreate,
        meta: { requiresAuth: true }
    },
    {
        name: "productos.edit",
        path: "/productos/:id/edit",
        component: ProductosEdit,
        meta: { requiresAuth: true }
    },
    //
    // Bodegas
    //
    {
        name: "bodegas.index",
        path: "/bodegas",
        component: BodegasIndex,
        meta: { requiresAuth: true }
    },
    {
        name: "bodegas.create",
        path: "/bodegas/create",
        component: BodegasCreate,
        meta: { requiresAuth: true }
    },
    {
        name: "bodegas.edit",
        path: "/bodegas/:id/edit",
        component: BodegasEdit,
        meta: { requiresAuth: true }
    },
    //
    // Facturas
    //
    {
        name: "facturas.index",
        path: "/facturas",
        component: FacturasIndex,
        meta: { requiresAuth: true }
    },
    {
        name: "facturas.create",
        path: "/facturas/create",
        component: FacturasCreate,
        meta: { requiresAuth: true }
    },
    {
        name: "facturas.show",
        path: "/facturas/:id",
        component: FacturasShow,
        meta: { requiresAuth: true }
    },
    {
        name: "facturas.edit",
        path: "/facturas/:id/edit",
        component: FacturasEdit,
        meta: { requiresAuth: true }
    },
    //
    // Usuarios
    //
    {
        name: "usuarios.create",
        path: "/usuarios/create",
        component: UsuariosCreate,
        meta: { requiresAuth: true }
    },
    {
        name: "usuarios.index",
        path: "/usuarios",
        component: UsuariosIndex,
        meta: { requiresAuth: true }
    },
    {
        name: "usuarios.edit",
        path: "/usuarios/:id/edit",
        component: UsuariosEdit,
        meta: { requiresAuth: true }
    },
    {
        name: "stocks.index",
        path: "/stocks",
        component: StocksIndex,
        meta: { requiresAuth: true }
    },
    //
    // Index
    //
    {
        name: "index",
        path: "/index",
        component: Index,
        //meta: { requiresAuth: true }
    }
];
