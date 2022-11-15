#Santoral

```
Esta es una API RESTful de santos. En la misma se pueden realizar acciones como filtrar y/o ordenar y/o paginar. Para esto se describirán a continuación los correspondientes endpoints
```
Para ordenar:
http://localhost/TPE2/api/santos?sort_by=nombre&order=desc
http://localhost/TPE2/api/santos?sort_by=pais&order=desc
http://localhost/TPE2/api/santos?sort_by=fecha_nacimiento&order=desc
http://localhost/TPE2/api/santos?sort_by=fecha_muerte&order=desc
http://localhost/TPE2/api/santos?sort_by=fecha_canonizacion&order=desc


Filtrar por país:
http://localhost/TPE2/api/santos?filter=nombreAtributo&input=datoParticular

Paginación:
http://localhost/TPE2/api/santos?size=3&page=numeroDePagina