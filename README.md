# Santoral

```
Esta es una API RESTful de santos.
En la misma se pueden realizar acciones como filtrar y/o ordenar y/o paginar.
Para esto se describirán a continuación los correspondientes endpoints
```

## Servicio GET

### Para listar la colección entera de santos:
```
http://localhost/API-Web2/api/saints
```
### Para ordenar por un campo de la tabla:
```
http://localhost/API-Web2/api/saints?sort_by=nombreDelCampo&order=AscendenteODescendente
```
*Ejemplos:*
```
http://localhost/API-Web2/api/saints?sort_by=pais&order=desc
http://localhost/API-Web2/api/saints?sort_by=fecha_nacimiento&order=asc
```

### Para filtrar por alguno de los campos de la tabla:
```
http://localhost/API-Web2/api/saints?filter=nombreDelCampo&input=datoParticular
```
*Ejemplos:*
```
http://localhost/API-Web2/api/saints?filter=pais&input=italia
http://localhost/API-Web2/api/saints?filter=congregacion_fk&input=italia
```

### Para paginar:
```
**http://localhost/API-Web2/api/saints?size=cantidadDeElementosAMostrar&page=numeroDePagina**
```
*Ejemplos:*
```
http://localhost/API-Web2/api/saints?size=3&page=1
http://localhost/API-Web2/api/saints?size=2&page=2
```
### Combinación de orden, filtrado y paginado
Usando los mismo parámetros anteriormente mencionados se puede hacer combinación de dos métodos (por ej. orden y páginado) o de los tres (por ej. filtrado orden y paginado). A continuación, se proponen algunos ejemplos:
```
http://localhost/API-Web2/api/saints?filter=pais&input=italia&sort_by=nombre&order=asc&size=2&page=1
http://localhost/API-Web2/api/saints?filter=congregacion_fk&input=5&sort_by=nombre&order=asc
http://localhost/API-Web2/api/saints?sort_by=nombre&order=asc&size=3&page=1
http://localhost/API-Web2/api/saints?filter=pais&input=italia&size=2&page=1
```
### Para listar la colección entera de congregaciones:
```
http://localhost/API-Web2/api/congregations
```

## Autenticación
Antes de describir los servicios POST, PUT y DELETE, es necesario detenernos en la autenticación, ya que sin esta no es posible emplear dichos servicios.

**PASO 1:** se establece el siguiente endpoint con el servicio GET
```
http://localhost/API-Web2/api/token
```
**PASO 2:** en la pestaña 'Authorization' seleccionar 'TYPE: Basic Auth' y escribir el Username y el Password. Luego, enviar la solicitud.

**PASO 3:** copiar el token generado.

**PASO 4:** antes de enviar una solicitud con los servicios POST, PUT o DELETE, en la pestaña 'Authorization' seleccionar 'TYPE: Bearer Token' y pegamos el token previamente copiado.

## Servicio POST
Este servicio es utilizado para insertar un nuevo santo

**PASO 1:** establcer el siguiente endpoint:
```
http://localhost/API-Web2/api/saints
```
**PASO 2:** en la pestaña 'Body' ingresar los datos del nuevo santo. Por ejemplo:

```
{
    "nombre": "Alberto Hurtado",
    "pais": "Chile",
    "fecha_nacimiento": "1890-07-16",
    "fecha_muerte": "1950-08-11",
    "fecha_canonizacion": "2022-09-26",
    "congregacion_fk": 5
}
```
Luego, enviar la solicitud.

## Servicio PUT
Este servicio es utilizado para modificar los datos de un santo existente

**PASO 1:** establcer el siguiente endpoint:
```
http://localhost/API-Web2/api/saints/idDelSantoAModificar
```
*Ejemplo:*

```
http://localhost/API-Web2/api/saints/14
```
**PASO 2:** en la pestaña 'Body' modificar los datos del santo. Por ejemplo:

```
{
    "id" : 14
    "nombre": "Alberto Hurtado",
    "pais": "Chile",
    "fecha_nacimiento": "1890-07-16",
    "fecha_muerte": "1950-08-11",
    "fecha_canonizacion": "2022-09-26",
    "congregacion_fk": 5
}
```
Luego, enviar la solicitud

## Servicio DELETE
Este servicio es utilizado para eliminar un santo

```
http://localhost/API-Web2/api/saints/idDelSantoAEliminar
```
*Ejemplo:*

```
http://localhost/API-Web2/api/saints/14
```