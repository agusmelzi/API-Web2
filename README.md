# Santoral

```
Esta es una API RESTful de santos.
En la misma se pueden realizar acciones como filtrar y/o ordenar y/o paginar.
Para esto se describirán a continuación los correspondientes endpoints
```

## Servicio GET

### Para listar la colección entera de santos:
```
**http://localhost/API-Web2/api/santos**
```
### Para ordenar por un campo de la tabla:
```
**http://localhost/API-Web2/api/santos?sort_by=nombreDelCampo&order=AscendenteODescendente**
```
Ejemplos:
```
http://localhost/API-Web2/api/santos?sort_by=pais&order=desc
http://localhost/API-Web2/api/santos?sort_by=fecha_nacimiento&order=asc
```

### Para filtrar por alguno de los campos de la tabla:
```
**http://localhost/API-Web2/api/santos?filter=nombreDelCampo&input=datoParticular**
```
Ejemplos:
```
http://localhost/API-Web2/api/santos?filter=pais&input=italia
http://localhost/API-Web2/api/santos?filter=congregacion_fk&input=italia
```

### Para paginar:
```
**http://localhost/API-Web2/api/santos?size=cantidadDeElementosAMostrar&page=numeroDePagina**
```
Ejemplos:
```
http://localhost/API-Web2/api/santos?size=3&page=1
http://localhost/API-Web2/api/santos?size=2&page=2
```
