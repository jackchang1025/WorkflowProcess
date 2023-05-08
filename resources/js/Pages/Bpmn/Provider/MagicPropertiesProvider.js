import {
    is
} from 'bpmn-js/lib/util/ModelUtil';


const LOW_PRIORITY = 200;

import {
    createRuleGroup
} from './Parts/RuleGroup';

export default function MagicPropertiesProvider(propertiesPanel, translate, ruleNameData, ruleExpressionData) {

    // Register our custom magic properties provider.
    // Use a lower priority to ensure it is loaded after the basic BPMN properties.
    propertiesPanel.registerProvider(LOW_PRIORITY, this);

    this.getGroups = function(element) {

        return function(groups) {

            // Add the "rule" group for sequenceFlow
            if (is(element, 'bpmn:SequenceFlow')) {
                groups.push(createRuleGroup(element, translate, ruleNameData, ruleExpressionData));
            }

            return groups;
        }
    };
}
