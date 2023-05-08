import ruleProps from './RuleProps';

// Create the custom rule group
export function createRuleGroup(element, translate, ruleNameData, ruleExpressionData) {

    // create a group called "Rule properties".
    return {
        id: 'rule',
        label: translate('Rule properties'),
        entries: ruleProps(element, ruleNameData, ruleExpressionData)
    };
}
