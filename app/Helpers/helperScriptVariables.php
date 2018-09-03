<?php
if (!function_exists('JavaScriptVariables')) {
    /**
     * Get default JavaScript variables.
     *
     * @return array
     */
    function JavaScriptVariables()
    {
        return [
            'csrfToken' => csrf_token(),
            'env' => config('app.env'),
            'userId' => Auth::id(),
            // 'translations' => (array) json_decode(file_get_contents(resource_path('lang/'.app()->getLocale().'.json'))) + ['teams.team' => trans('teams.team'), 'teams.member' => trans('teams.member')],
        ];
    }
}
