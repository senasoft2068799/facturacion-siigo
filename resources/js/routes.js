import Register from "./pages/Auth/Register.vue";
import Inicio from "./pages/Auth/Inicio.vue";
import Dashboard from "./pages/Dashboard.vue";
import RolesIndex from "./pages/Roles/Index.vue";
import RolesShow from "./pages/Roles/Show.vue";
import RolesCreate from "./pages/Roles/Create.vue";
import RolesEdit from "./pages/Roles/Edit.vue";
import DocumentosIndex from "./pages/Documentos/Index.vue";
import DocumentosCreate from "./pages/Documentos/Create.vue";
import DocumentosEdit from "./pages/Documentos/Edit.vue";
import SucursalesIndex from "./pages/Sucursales/Index.vue";
import SucursalesCreate from "./pages/Sucursales/Create.vue";
import SucursalesEdit from "./pages/Sucursales/Edit.vue";
import MovimientosIndex from "./pages/Movimientos/Index.vue";
import MovimientosCreate from "./pages/Movimientos/Create.vue";
import MovimientosEdit from "./pages/Movimientos/Edit.vue";
import BodegasIndex from "./pages/Bodegas/Index.vue";
import BodegasCreate from "./pages/Bodegas/Create.vue";
import BodegasEdit from "./pages/Bodegas/Edit.vue";
import FacturasIndex from "./pages/Facturas/Index.vue";
import FacturasShow from "./pages/Facturas/Show.vue";
import FacturasCreate from "./pages/Facturas/Create.vue";
import FacturasEdit from "./pages/Facturas/Edit.vue";

export const routes = [
    //
    // Dashboard
    //
    {
        name: "register",
        path: "/registrar",
        component: Register
    },
    {
        name: "inicio",
        path: "/inicio",
        component: Inicio
    },
    {
        name: "dashboard",
        path: "/",
        component: Dashboard
    },
    //
    // Roles
    //
    {
        name: "roles.index",
        path: "/roles",
        component: RolesIndex
    },
    {
        name: "roles.show",
        path: "/roles/:id/",
        component: RolesShow
    },

    {
        name: "roles.create",
        path: "/roles/create",
        component: RolesCreate
    },

    {
        name: "roles.edit",
        path: "/roles/:id/edit",
        component: RolesEdit
    },
    //
    // Documentos
    //
    {
        name: "documentos.index",
        path: "/documentos",
        component: DocumentosIndex
    },
    {
        name: "documentos.create",
        path: "/documentos/create",
        component: DocumentosCreate
    },
    {
        name: "documentos.edit",
        path: "/documentos/:id/edit",
        component: DocumentosEdit
    },
    //
    // Sucursales
    //
    {
        name: "sucursales.index",
        path: "/sucursales",
        component: SucursalesIndex
    },
    {
        name: "sucursales.create",
        path: "/sucursales/create",
        component: SucursalesCreate
    },
    {
        name: "sucursales.edit",
        path: "/sucursales/:id/edit",
        component: SucursalesEdit
    },
    //
    // Movimientos
    //
    {
        name: "movimientos.index",
        path: "/movimientos",
        component: MovimientosIndex
    },
    {
        name: "movimientos.create",
        path: "/movimientos/create",
        component: MovimientosCreate
    },
    {
        name: "movimientos.edit",
        path: "/movimientos/:id/edit",
        component: MovimientosEdit
    },
    //
    // Bodegas
    //
    {
        name: "bodegas.index",
        path: "/bodegas",
        component: BodegasIndex
    },
    {
        name: "bodegas.create",
        path: "/bodegas/create",
        component: BodegasCreate
    },
    {
        name: "bodegas.edit",
        path: "/bodegas/:id/edit",
        component: BodegasEdit
    },
    //
    // Facturas
    //
    {
        name: "facturas.index",
        path: "/facturas",
        component: FacturasIndex
    },
    {
        name: "facturas.create",
        path: "/facturas/create",
        component: FacturasCreate
    },
    {
        name: "facturas.show",
        path: "/facturas/:id",
        component: FacturasShow
    },
    {
        name: "facturas.edit",
        path: "/facturas/:id/edit",
        component: FacturasEdit
    }
];
