<?php

namespace RockAdminTweaks;

use ProcessWire\HookEvent;
use ProcessWire\Inputfield;

class ModuleCollapseInfo extends Tweak
{
    public function info()
    {
        return [
            'description' => 'Collapse Module Info section by default',
        ];
    }


    public function ready()
    {
        if ($this->wire->page->template != 'admin') {
            return;
        }

        if ($this->page->process && $this->page->process == 'ProcessModule') {
            $this->wire('processBrowserTitle', $this->input->get('name'));
        }

        $this->wire->addHookAfter('InputfieldMarkup::render', function (HookEvent $event) {
            $field = $event->object;
            if ($field->id === 'ModuleInfo') {
                $field->collapsed = Inputfield::collapsedYes;
            }
        });
    }
}
