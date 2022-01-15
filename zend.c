/* include les headers standard */
#include "php.h"
/* déclaration de fonctions à exporter */
ZEND_FUNCTION(first_module);
/* Liste de fonctions compilées pour que Zend sache ce qui se passe dans ce module */
zend_function_entry firstmod_functions[] =
{
ZEND_FE(first_module, NULL)
{NULL, NULL, NULL}
};
/* informations sur le module compilé */
zend_module_entry firstmod_module_entry =
{
STANDARD_MODULE_HEADER,
"First Module",
firstmod_functions,
NULL,
NULL,
NULL,
NULL,
NULL,
NO_VERSION_YET,
STANDARD_MODULE_PROPERTIES
};
/* Implémente une routine "stub" standard pour nous présenter à Zend */
#if COMPILE_DL_FIRST_MODULE
ZEND_GET_MODULE(firstmod)
#endif
/* Implémente la fonction qui sera disponible dans PHP */
ZEND_FUNCTION(first_module)
{
long parameter;
if (zend_parse_parameters(ZEND_NUM_ARGS() TSRMLS_CC, "l", == FAILURE) {
return;
}
RETURN_LONG(parameter);
}