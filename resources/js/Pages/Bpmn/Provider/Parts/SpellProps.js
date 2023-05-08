import {TextFieldEntry, isTextFieldEntryEdited, SelectEntry} from '@bpmn-io/properties-panel';
import { useService } from 'bpmn-js-properties-panel';
import React from "@bpmn-io/properties-panel/preact/compat";
import {jsx} from "@bpmn-io/properties-panel/preact/jsx-runtime";

export default function(element) {

    return [
        {
            id: 'spell',
            element,
            component: Spell,
            isEdited: isTextFieldEntryEdited
        }
    ];
}

function Spell(props) {
    const { element, id } = props;

    const modeling = useService('modeling');
    const translate = useService('translate');
    const debounce = useService('debounceInput');

    const getValue = () => {
        return element.businessObject.spell || '';
    }

    const setValue = value => {
        return modeling.updateProperties(element, {
            spell: value
        });
    }

    return jsx(SelectEntry, {
        id: id,
        element: element,
        label: translate('Rule Name'),
        getValue: getValue,
        setValue: setValue,
        getOptions: getOptions,
        debounce: debounce,
    });

    // return <TextFieldEntry
    //     id={ id }
    //     element={ element }
    //     description={ translate('Apply a black magic spell') }
    //     label={ translate('Spell') }
    //     getValue={ getValue }
    //     setValue={ setValue }
    //     debounce={ debounce }
    // />
}
