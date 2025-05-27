<?php
// Patrones
$patronNombreYApellidos = "/^([A-ZÁÉÍÓÚÑ][a-záéíóúüñ]+(\s[A-ZÁÉÍÓÚÑ][a-záéíóúüñ]+){0,3})$/"; // Hasta 3 palabras con mayúscula inicial y letras con acentos
$patronEmail = "/^[A-Za-zÁÉÍÓÚÄËÏÖÜ0-9._%+-]+@[A-Za-z]+\.(com|es)$/"; // Email válido con caracteres especiales opcionales y extensión .com o .es
$patronFecha = "/^(18|19|20)\d{2}\-(0[1-9]|1[0-2])\-(0[1-9]|[12][0-9]|3[01])$/"; // Fecha en formato yyyy/mm/dd con año entre 1800 y 2099
$patronDni = "/^\d{8}[A-Z]$/"; // DNI español con 8 dígitos y una letra mayúscula