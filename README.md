#### Cube-Summation-Challenge

### Framework o paradigmas de programacíon usada

Uso del framework PHP CodeIgniter
CodeIgniter beneficios:
- Arquitectura simple de archivos
- Framework implementando el patrón de diseño MVC
- Facil de manejarlo y ligero
- Validación de formularios y gestión de errores poderosas


### Descripción de cada una de las capas

## Capa Modelo

Contiene la definición de mi objeto de cubo con sus propiedades <code>n</code> (tamaño del plano) y <code>matrix</code> (plan con 3 dimensiones de tamaño n)
Contiene los métodos <code>UPDATE</code> y <code>QUERY</code>.

## Capa Controlador


Contiene todas las funciones del proceso de validación de formularios y de cálculo del cubo.

# function calculCube() 
Método de controlador llamado a la presentación de formulario que contiene todos los datos de las pruebas y las llamadas a métodos <code>UPDATE</code> y <code>QUERY</code> del modelo.

# function nb_tests_check(int $num)
Verifica de que 1 <T <50.

# function number_cases_check(String $str)
Verifica que el número de pruebas del textarea es igual a T.

# function number_instructions_check(String $str)
Verifica que el número de instrucciones es igual a M y verifica que 1 <M <1,000.

# function split_multidimensionnal_array(String $str) 
Convierte la cadena del textarea en una matriz multidimensional.

## Capa Vista
Contiene la vista que muestra las formas de entrada y salida de la aplicación.