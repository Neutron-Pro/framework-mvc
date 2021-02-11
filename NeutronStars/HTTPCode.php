<?php
namespace NeutronStars;


class HTTPCode
{
    /* INFORMATION CODES */
    const CODE_100 = '100 Continue';
    const CODE_101 = '101 Switching Protocols';
    const CODE_102 = '102 Processing';
    const CODE_103 = '103 Early Hints';

    /* SUCCESS CODES */
    const CODE_200 = '200 OK';
    const CODE_201 = '201 Created';
    const CODE_202 = '202 Accepted';
    const CODE_203 = '203 Non-Authoritative Information';
    const CODE_204 = '204 No Content';
    const CODE_205 = '205 Reset Content';
    const CODE_206 = '206 Partial Content';
    const CODE_207 = '207 Multi-Status';
    const CODE_208 = '208 Already Reported';
    const CODE_210 = '210 Content Different';
    const CODE_226 = '226 IM Used';

    /* REDIRECTION CODES */
    const CODE_300 = '300 Multiple Choices';
    const CODE_301 = '301 Moved Permanently';
    const CODE_302 = '302 Found';
    const CODE_303 = '303 See Other';
    const CODE_304 = '304 Not Modified';
    const CODE_305 = '305 Use Proxy';
    const CODE_306 = '306 Switch Proxy';
    const CODE_307 = '307 Temporary Redirect';
    const CODE_308 = '308 Permanent Redirect';
    const CODE_310 = '310 Too many Redirect';

    /* ERROR CODES FOR WEB CLIENT */
    const CODE_400 = '400 Bad Request';
    const CODE_401 = '401 Unauthorized';
    const CODE_402 = '402 Payment Required';
    const CODE_403 = '403 Forbidden';
    const CODE_404 = '404 Not Found';
    const CODE_405 = '405 Method Not Allowed';
    const CODE_406 = '406 Not Acceptable';
    const CODE_407 = '407 Proxy Authentification Required';
    const CODE_408 = '408 Request Time-out';
    const CODE_409 = '409 Conflict';
    const CODE_410 = '410 Gone';
    const CODE_411 = '411 Length Required';
    const CODE_412 = '412 Precondition Failed';
    const CODE_413 = '404 Request Entity Too Large';
    const CODE_414 = '414 Request-URI Too Long';
    const CODE_415 = '415 Unsupported Media Type';
    const CODE_416 = '416 Requested Range Unsatisfiable';
    const CODE_417 = '417 Expectation Failed';
    const CODE_418 = '418 I\'m a teapot';
    const CODE_421 = '421 Bad Mapping / Misdirected Request';
    const CODE_422 = '422 Unprocessable Entity';
    const CODE_423 = '423 Locked';
    const CODE_424 = '424 Method Failure';
    const CODE_425 = '425 Too Early';
    const CODE_426 = '426 Upgrade Required';
    const CODE_428 = '428 Precondition Redirect';
    const CODE_429 = '429 Too Many Requests';
    const CODE_431 = '431 Request Header Fields Too Large';
    const CODE_449 = '449 Retry With';
    const CODE_450 = '450 Blocked By Windows Parental Controls';
    const CODE_451 = '451 Unavailable For Legal Reasons';
    const CODE_456 = '456 Unrecoverable Error';

    /* ERROR CODES FOR NGINX */
    const CODE_444 = '444 No Response';
    const CODE_495 = '495 SSL Certificate Error';
    const CODE_496 = '496 SSL Certificate Required';
    const CODE_497 = '497 HTTP Request Sent To HTTPS Port';
    const CODE_498 = '498 Token Expired/Invalid';
    const CODE_499 = '499 Client Closed Request';

    /* ERROR CODES FOR WEB SERVER */
    const CODE_500 = '500 Internal Server Error';
    const CODE_501 = '501 Not Implemented';
    const CODE_502 = '502 Bad Gateway or Proxy Error';
    const CODE_503 = '503 Service Unavailable';
    const CODE_504 = '504 Gateway Time-out';
    const CODE_505 = '505 HTTP Version Not Supported';
    const CODE_506 = '506 Variante Also Negotiates';
    const CODE_507 = '507 Insufficient Storage';
    const CODE_508 = '508 Loop Detected';
    const CODE_509 = '509 Bandwidth Limit Exceeded';
    const CODE_510 = '510 Not Extended';
    const CODE_511 = '511 Network Authentification Required';

    /* ERROR CODE EXTENDED TO CLOUDFLARE MANDATAIRE */
    const CODE_520 = '520 Unknown Error';
    const CODE_521 = '521 Web Server Is Down';
    const CODE_522 = '522 Connection Timed-out';
    const CODE_523 = '523 Origin Is Unreachable';
    const CODE_524 = '524 A Timeout Occurred';
    const CODE_525 = '525 SSL Handshake Failed';
    const CODE_526 = '526 Invalid SSL Certificate';
    const CODE_527 = '527 Railgun Error';
}
