-- HOMOLOGACION AUTOMATICA CATEGORIAS PARA TIRANT

insert into categorias_x_cat_pro (id_categorias, id_categorias_proveedores)
SELECT distinct c.id_categorias,  cp.id_categorias_proveedores FROM categorias c 
inner join categorias_proveedores cp on (lower(trim(cp.nombre)) = lower(trim(c.nombre))) or (locate(lower(trim(c.nombre)),lower(trim(cp.nombre))))  or (locate(lower(trim(cp.nombre)),lower(trim(c.nombre))))
where cp.id_proveedores = 2
order by c.id_categorias ;

-- FIN HOMOLOGACION AUTOMATICA CATEGORIAS PARA TIRANT

-- HOMOLOGACION AUTOMATICA CATEGORIAS PARA PUBLIDISA

insert into categorias_x_cat_pro (id_categorias, id_categorias_proveedores)
SELECT distinct c.id_categorias,  cp.id_categorias_proveedores FROM categorias c 
inner join categorias_proveedores cp on (lower(trim(cp.nombre)) = lower(trim(c.nombre))) or (locate(lower(trim(c.nombre)),lower(trim(cp.nombre))))  or (locate(lower(trim(cp.nombre)),lower(trim(c.nombre))))
where cp.id_proveedores = 3
order by c.id_categorias ;

-- FIN HOMOLOGACION AUTOMATICA CATEGORIAS PARA PUBLIDISA

--- Caraga automatica de titulos en categorias homologadas para todos los proveedores

truncate titulos_categorias;

insert into titulos_categorias (id_categorias, id_titulos)
select cxcp.id_categorias, t.id_titulos from categorias_x_cat_pro as cxcp 
inner join categorias_proveedores as cp on cp.id_categorias_proveedores = cxcp.id_categorias_proveedores 
inner join titulos_cat_pro as tcp on tcp.id_categorias_proveedores = cp.id_categorias_proveedores 
inner join titulos as t on t.id_titulos = tcp.id_titulos where cxcp.id_categorias!=14

--fin carga automatica de titulos en categorias homologadas para todos los proveedores

--- ingresar titulos no homologados a categoria 229 sin clasificar para todos los proveedores
insert into titulos_categorias (id_categorias, id_titulos)
select distinct 229,t.id_titulos from titulos as t where
t.id_titulos not in (select distinct tc.id_titulos from titulos_categorias as tc)

--- fin ingresar titulos no homologados a categoria 229 sin clasificar para todos los proveedores


---- INGRESAR REVISTAS

insert into titulos_categorias (id_titulos, id_categorias) select id_titulos, 14 from titulos_atributos where llave='titulo' and valor like '%revista%'