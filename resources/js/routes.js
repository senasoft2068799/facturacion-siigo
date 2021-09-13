import DocumentosIndex from "./components/Documentos/Index.vue";
import DocumentosCreate from "./components/Documentos/Create.vue";
import DocumentosEdit from "./components/Documentos/Edit.vue";
import SucursalesIndex from "./components/Sucursales/Index.vue";
import SucursalesCreate from "./components/Sucursales/Create.vue";
import SucursalesEdit from "./components/Sucursales/Edit.vue";
import MovimientosIndex from "./components/Movimientos/Index.vue";
import MovimientosCreate from "./components/Movimientos/Create.vue";
import MovimientosEdit from "./components/Movimientos/Edit.vue";

export const routes = [
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
    }
];
