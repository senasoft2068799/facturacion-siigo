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

export const routes = [
    // Documentos
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
    // Sucursales
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
    // Movimientos
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
    // Bodegas
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
    }
];
