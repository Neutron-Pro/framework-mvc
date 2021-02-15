<?php

namespace NeutronStars\Service;

class HTTPCode
{
    /* INFORMATION CODES */
    public const CODE_100 = '100 Continue';
    public const CODE_101 = '101 Switching Protocols';
    public const CODE_102 = '102 Processing';
    public const CODE_103 = '103 Early Hints';
/* SUCCESS CODES */
    public const CODE_200 = '200 OK';
    public const CODE_201 = '201 Created';
    public const CODE_202 = '202 Accepted';
    public const CODE_203 = '203 Non-Authoritative Information';
    public const CODE_204 = '204 No Content';
    public const CODE_205 = '205 Reset Content';
    public const CODE_206 = '206 Partial Content';
    public const CODE_207 = '207 Multi-Status';
    public const CODE_208 = '208 Already Reported';
    public const CODE_210 = '210 Content Different';
    public const CODE_226 = '226 IM Used';
/* REDIRECTION CODES */
    public const CODE_300 = '300 Multiple Choices';
    public const CODE_301 = '301 Moved Permanently';
    public const CODE_302 = '302 Found';
    public const CODE_303 = '303 See Other';
    public const CODE_304 = '304 Not Modified';
    public const CODE_305 = '305 Use Proxy';
    public const CODE_306 = '306 Switch Proxy';
    public const CODE_307 = '307 Temporary Redirect';
    public const CODE_308 = '308 Permanent Redirect';
    public const CODE_310 = '310 Too many Redirect';
/* ERROR CODES FOR WEB CLIENT */
    public const CODE_400 = '400 Bad Request';
    public const CODE_401 = '401 Unauthorized';
    public const CODE_402 = '402 Payment Required';
    public const CODE_403 = '403 Forbidden';
    public const CODE_404 = '404 Not Found';
    public const CODE_405 = '405 Method Not Allowed';
    public const CODE_406 = '406 Not Acceptable';
    public const CODE_407 = '407 Proxy Authentification Required';
    public const CODE_408 = '408 Request Time-out';
    public const CODE_409 = '409 Conflict';
    public const CODE_410 = '410 Gone';
    public const CODE_411 = '411 Length Required';
    public const CODE_412 = '412 Precondition Failed';
    public const CODE_413 = '404 Request Entity Too Large';
    public const CODE_414 = '414 Request-URI Too Long';
    public const CODE_415 = '415 Unsupported Media Type';
    public const CODE_416 = '416 Requested Range Unsatisfiable';
    public const CODE_417 = '417 Expectation Failed';
    public const CODE_418 = '418 I\'m a teapot';
    public const CODE_419 = '419 Authentification Timeout';
    public const CODE_421 = '421 Bad Mapping / Misdirected Request';
    public const CODE_422 = '422 Unprocessable Entity';
    public const CODE_423 = '423 Locked';
    public const CODE_424 = '424 Method Failure';
    public const CODE_425 = '425 Too Early';
    public const CODE_426 = '426 Upgrade Required';
    public const CODE_428 = '428 Precondition Redirect';
    public const CODE_429 = '429 Too Many Requests';
    public const CODE_431 = '431 Request Header Fields Too Large';
    public const CODE_449 = '449 Retry With';
    public const CODE_450 = '450 Blocked By Windows Parental Controls';
    public const CODE_451 = '451 Unavailable For Legal Reasons';
    public const CODE_456 = '456 Unrecoverable Error';
/* ERROR CODES FOR NGINX */
    public const CODE_444 = '444 No Response';
    public const CODE_495 = '495 SSL Certificate Error';
    public const CODE_496 = '496 SSL Certificate Required';
    public const CODE_497 = '497 HTTP Request Sent To HTTPS Port';
    public const CODE_498 = '498 Token Expired/Invalid';
    public const CODE_499 = '499 Client Closed Request';
/* ERROR CODES FOR WEB SERVER */
    public const CODE_500 = '500 Internal Server Error';
    public const CODE_501 = '501 Not Implemented';
    public const CODE_502 = '502 Bad Gateway or Proxy Error';
    public const CODE_503 = '503 Service Unavailable';
    public const CODE_504 = '504 Gateway Time-out';
    public const CODE_505 = '505 HTTP Version Not Supported';
    public const CODE_506 = '506 Variante Also Negotiates';
    public const CODE_507 = '507 Insufficient Storage';
    public const CODE_508 = '508 Loop Detected';
    public const CODE_509 = '509 Bandwidth Limit Exceeded';
    public const CODE_510 = '510 Not Extended';
    public const CODE_511 = '511 Network Authentification Required';
/* ERROR CODE EXTENDED TO CLOUDFLARE MANDATAIRE */
    public const CODE_520 = '520 Unknown Error';
    public const CODE_521 = '521 Web Server Is Down';
    public const CODE_522 = '522 Connection Timed-out';
    public const CODE_523 = '523 Origin Is Unreachable';
    public const CODE_524 = '524 A Timeout Occurred';
    public const CODE_525 = '525 SSL Handshake Failed';
    public const CODE_526 = '526 Invalid SSL Certificate';
    public const CODE_527 = '527 Railgun Error';
}
