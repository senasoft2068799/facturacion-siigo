import DocumentosIndex from "./components/Documentos/Index.vue";
import DocumentosCreate from "./components/Documentos/Create.vue";
import DocumentosEdit from "./components/Documentos/Edit.vue";
import SucursalesIndex from "./components/Sucursales/Index.vue";
import SucursalesCreate from "./components/Sucursales/Create.vue";
import SucursalesEdit from "./components/Sucursales/Edit.vue";
import MovimientosIndex from "./components/Movimientos/Index.vue";
import MovimientosCreate from "./components/Movimientos/Create.vue";
import MovimientosEdit from "./components/Movimientos/Edit.vue";
import CategoriasIndex from "./components/Categorias/Index.vue";
import CategoriasCreate from "./components/Categorias/Create.vue";
import CategoriasEdit from "./components/Categorias/Edit.vue";
import ProductosIndex from "./components/Productos/Index.vue";
import ProductosCreate from "./components/Productos/Create.vue";
import ProductosEdit from "./components/Productos/Edit.vue";

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
    },
    {
        name: "categorias.index",
        path: "/categorias",
        component: CategoriasIndex
    },
    {
        name: "categorias.create",
        path: "/categorias/create",
        component: CategoriasCreate
    },
    {
        name: "categorias.edit",
        path: "/categorias/:id/edit",
        component: CategoriasEdit
    }
    ,
    {
        name: "productos.index",
        path: "/productos",
        component: ProductosIndex
    },
    {
        name: "productos.create",
        path: "/productos/create",
        component: ProductosCreate
    },
    {
        name: "productos.edit",
        path: "/productos/:id/edit",
        component: ProductosEdit
    }
];
