// import { SelectEntry, isOptionSelected } from '@bpmn-io/properties-panel';
import { SelectEntry } from '@bpmn-io/properties-panel';
import { useService } from 'bpmn-js-properties-panel';
import React from "@bpmn-io/properties-panel/preact/compat";

export default function (element, ruleNameData, ruleExpressionData) {
    return [
        {
            id: 'ruleName',
            element,
            component: (props) => RuleName(props, ruleNameData),
            // isEdited: isOptionSelected,
        },
        {
            id: 'ruleExpression',
            element,
            component: (props) => RuleExpression(props, ruleExpressionData),
            // isEdited: isOptionSelected,
        },
    ];
}

function RuleName(props, ruleNameData) {
    const { element, id } = props;

    const modeling = useService('modeling');
    const translate = useService('translate');
    const debounce = useService('debounceInput');

    const getValue = () => {
        return element.businessObject.ruleName || '';
    };

    const setValue = (value) => {
        return modeling.updateProperties(element, {
            ruleName: value,
        });
    };

    const getOptions = () => {
        return ruleNameData.map((item) => ({ value: item, label: item }));
    };

    return React.createElement(SelectEntry, {
        id: id,
        element: element,
        label: translate('Rule Name'),
        getValue: getValue,
        setValue: setValue,
        getOptions: getOptions,
        debounce: debounce,
    });
}

function RuleExpression(props, ruleExpressionData) {
    const { element, id } = props;

    const modeling = useService('modeling');
    const translate = useService('translate');
    const debounce = useService('debounceInput');

    const getValue = () => {
        return element.businessObject.ruleExpression || '';
    };

    const setValue = (value) => {
        return modeling.updateProperties(element, {
            ruleExpression: value,
        });
    };

    const getOptions = () => {
        return ruleExpressionData.map((item) => ({ value: item, label: item }));
    };

    return React.createElement(SelectEntry, {
        id: id,
        element: element,
        label: translate('Rule Expression'),
        getValue: getValue,
        setValue: setValue,
        getOptions: getOptions,
        debounce: debounce,
    });
}
