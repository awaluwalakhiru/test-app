<?php

/**
 *	Helpers
 */
function buildJson($code, $message, $data = null, $redirect = null)
{
    return response()->json(buildJsonArray($code, $message, $data, $redirect), $code);
}

function buildErrorJson($code, $message, $data = null, $errors = null, $redirect = null, $stacktrace = null)
{
    $data = buildJsonArray($code, $message, $data, $redirect);
    if ($errors) $data['meta']['errors'] = $errors;
    if ($stacktrace) $data['meta']['stacktrace'] = $stacktrace;
    return response()->json($data, $code);
}

function buildJsonArray($code, $message, $data = null, $redirect = null)
{
    $response = [
        'meta' => [
            'code' => $code,
            'message' => $message
        ]
    ];
    if ($data) $response['data'] = $data;
    if ($redirect) $response['meta']['redirect'] = $redirect;
    return $response;
}

function buildJsonString($code, $message, $data = null, $redirect = null)
{
    return json_encode(buildJsonArray($code, $message, $data));
}

function queryExact($q)
{
    return addcslashes($q, '%_\\');
}

function queryContains($q)
{
    return '%' . queryExact($q) . '%';
}

function queryStartsWith($q)
{
    return queryExact($q) . '%';
}

function queryEndsWith($q)
{
    return '%' . queryExact($q);
}

function wrapPaginate($query, $perpage, $page)
{
    $data = null;
    if ($page) {
        $result = $query->simplePaginate($perpage)->toArray();
        $list = $result['data'];
        $data = [
            'list' => $list,
            'pagination' => [
                'page' => $result['current_page'],
                'per_page' => $result['per_page'],
                'prev' => ((bool) $result['prev_page_url']),
                'next' => ((bool) $result['next_page_url']),
            ]
        ];
    } else {
        $data = [
            'list' => $query->get()
        ];
    }
    return $data;
}
