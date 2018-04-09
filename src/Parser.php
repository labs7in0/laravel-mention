<?php

namespace Labs7in0\Mention;

class Parser
{
    protected $users = [];
    protected $route;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->route = config('mention.route', 'profile');
    }

    /**
     * Parse a text and determine if it contains mentions.
     */
    public function parse($body)
    {
        $users = $this->mentioned($body);

        if (count($users) > 0) {
            $model = app()->make(config('mention.model', 'App\User'));
            $column = config('mention.column', 'name');
            $this->users = $model::whereIn($column, $users)->get();

            if (config('mention.notification', null)) {
                $this->notify();
            }
        }

        return $this->replace($body);
    }

    /**
     * Handle mentions and return the array of user names.
     */
    protected function mentioned($body)
    {
        $regex = config('mention.regex', "/(\S*)\@([^\r\n\s]*)/i");

        preg_match_all($regex, $body, $atListTmp);
        $users = [];
        foreach ($atListTmp[2] as $key => $value) {
            if ($atListTmp[1][$key]) {
                continue;
            }
            $users[] = $value;
        }

        return array_unique($users);
    }

    /**
     * Notify the mentions users.
     */
    protected function notify()
    {
        //
    }

    /**
     * Replace the mentions.
     */
    protected function replace($body)
    {
        switch (config('mention.format', 'markdown')) {
            case 'bbcode':
                return $this->replaceBbcode($body);
                break;
            case 'html':
                return $this->replaceHtml($body);
                break;
            case 'markdown':
                return $this->replaceMarkdown($body);
                break;
            default:
                throw new \Exception('Unsupported Format');
        }
    }

    /**
     * Replace the mentions with BBCode links.
     */
    protected function replaceBbcode($body)
    {
        foreach ($this->users as $user) {
            $column = config('mention.column', 'name');
            $search = '@' . $user->{$column};
            $place = '[url=' . route($this->route, $user->id) . ']' . $search . '[/url]';
            $body = str_replace($search, $place, $body);
        }

        return $body;
    }

    /**
     * Replace the mentions with HTML links.
     */
    protected function replaceHtml($body)
    {
        foreach ($this->users as $user) {
            $column = config('mention.column', 'name');
            $search = '@' . $user->{$column};
            $place = '<a href="' . route($this->route, $user->id) . '">' . $search . '</a>';
            $body = str_replace($search, $place, $body);
        }

        return $body;
    }

    /**
     * Replace the mentions with markdown links.
     */
    protected function replaceMarkdown($body)
    {
        foreach ($this->users as $user) {
            $column = config('mention.column', 'name');
            $search = '@' . $user->{$column};
            $place = '[' . $search . '](' . route($this->route, $user->id) . ')';
            $body = str_replace($search, $place, $body);
        }

        return $body;
    }
}
