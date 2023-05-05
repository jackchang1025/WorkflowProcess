<?php

/**
 * A helper file for Dcat Admin, to provide autocomplete information to your IDE
 *
 * This file should not be included in your code, only analyzed by your IDE!
 *
 * @author jqh <841324345@qq.com>
 */
namespace Dcat\Admin {
    use Illuminate\Support\Collection;

    /**
     * @property Grid\Column|Collection id
     * @property Grid\Column|Collection name
     * @property Grid\Column|Collection type
     * @property Grid\Column|Collection version
     * @property Grid\Column|Collection detail
     * @property Grid\Column|Collection created_at
     * @property Grid\Column|Collection updated_at
     * @property Grid\Column|Collection is_enabled
     * @property Grid\Column|Collection parent_id
     * @property Grid\Column|Collection order
     * @property Grid\Column|Collection icon
     * @property Grid\Column|Collection uri
     * @property Grid\Column|Collection extension
     * @property Grid\Column|Collection permission_id
     * @property Grid\Column|Collection menu_id
     * @property Grid\Column|Collection slug
     * @property Grid\Column|Collection http_method
     * @property Grid\Column|Collection http_path
     * @property Grid\Column|Collection role_id
     * @property Grid\Column|Collection user_id
     * @property Grid\Column|Collection value
     * @property Grid\Column|Collection username
     * @property Grid\Column|Collection password
     * @property Grid\Column|Collection avatar
     * @property Grid\Column|Collection remember_token
     * @property Grid\Column|Collection uuid
     * @property Grid\Column|Collection connection
     * @property Grid\Column|Collection queue
     * @property Grid\Column|Collection payload
     * @property Grid\Column|Collection exception
     * @property Grid\Column|Collection failed_at
     * @property Grid\Column|Collection lottery_group_id
     * @property Grid\Column|Collection lottery_id
     * @property Grid\Column|Collection code
     * @property Grid\Column|Collection period
     * @property Grid\Column|Collection period_interval
     * @property Grid\Column|Collection url
     * @property Grid\Column|Collection length
     * @property Grid\Column|Collection status
     * @property Grid\Column|Collection start_time
     * @property Grid\Column|Collection end_time
     * @property Grid\Column|Collection describe
     * @property Grid\Column|Collection deleted_at
     * @property Grid\Column|Collection driver_type
     * @property Grid\Column|Collection rule
     * @property Grid\Column|Collection odds
     * @property Grid\Column|Collection email
     * @property Grid\Column|Collection token
     * @property Grid\Column|Collection tokenable_type
     * @property Grid\Column|Collection tokenable_id
     * @property Grid\Column|Collection abilities
     * @property Grid\Column|Collection last_used_at
     * @property Grid\Column|Collection expires_at
     * @property Grid\Column|Collection bpmn_xml
     * @property Grid\Column|Collection token_id
     * @property Grid\Column|Collection code_type
     * @property Grid\Column|Collection lottery_rules
     * @property Grid\Column|Collection lottery_count_rules
     * @property Grid\Column|Collection bet_base_amount_rules
     * @property Grid\Column|Collection bet_total_amount_rules
     * @property Grid\Column|Collection bet_amount_rules
     * @property Grid\Column|Collection bet_code_rules
     * @property Grid\Column|Collection bet_count_rules
     * @property Grid\Column|Collection win_lose_rules
     * @property Grid\Column|Collection continuous_lose_count_rules
     * @property Grid\Column|Collection continuous_win_count_rules
     * @property Grid\Column|Collection total_amount_rules
     * @property Grid\Column|Collection request_id
     * @property Grid\Column|Collection issue
     * @property Grid\Column|Collection bet_code
     * @property Grid\Column|Collection bet_code_transform_value
     * @property Grid\Column|Collection bet_code_odds
     * @property Grid\Column|Collection lottery_code
     * @property Grid\Column|Collection bet_amount
     * @property Grid\Column|Collection bet_total_amount
     * @property Grid\Column|Collection win_lose
     * @property Grid\Column|Collection lottery_option_id
     * @property Grid\Column|Collection email_verified_at
     *
     * @method Grid\Column|Collection id(string $label = null)
     * @method Grid\Column|Collection name(string $label = null)
     * @method Grid\Column|Collection type(string $label = null)
     * @method Grid\Column|Collection version(string $label = null)
     * @method Grid\Column|Collection detail(string $label = null)
     * @method Grid\Column|Collection created_at(string $label = null)
     * @method Grid\Column|Collection updated_at(string $label = null)
     * @method Grid\Column|Collection is_enabled(string $label = null)
     * @method Grid\Column|Collection parent_id(string $label = null)
     * @method Grid\Column|Collection order(string $label = null)
     * @method Grid\Column|Collection icon(string $label = null)
     * @method Grid\Column|Collection uri(string $label = null)
     * @method Grid\Column|Collection extension(string $label = null)
     * @method Grid\Column|Collection permission_id(string $label = null)
     * @method Grid\Column|Collection menu_id(string $label = null)
     * @method Grid\Column|Collection slug(string $label = null)
     * @method Grid\Column|Collection http_method(string $label = null)
     * @method Grid\Column|Collection http_path(string $label = null)
     * @method Grid\Column|Collection role_id(string $label = null)
     * @method Grid\Column|Collection user_id(string $label = null)
     * @method Grid\Column|Collection value(string $label = null)
     * @method Grid\Column|Collection username(string $label = null)
     * @method Grid\Column|Collection password(string $label = null)
     * @method Grid\Column|Collection avatar(string $label = null)
     * @method Grid\Column|Collection remember_token(string $label = null)
     * @method Grid\Column|Collection uuid(string $label = null)
     * @method Grid\Column|Collection connection(string $label = null)
     * @method Grid\Column|Collection queue(string $label = null)
     * @method Grid\Column|Collection payload(string $label = null)
     * @method Grid\Column|Collection exception(string $label = null)
     * @method Grid\Column|Collection failed_at(string $label = null)
     * @method Grid\Column|Collection lottery_group_id(string $label = null)
     * @method Grid\Column|Collection lottery_id(string $label = null)
     * @method Grid\Column|Collection code(string $label = null)
     * @method Grid\Column|Collection period(string $label = null)
     * @method Grid\Column|Collection period_interval(string $label = null)
     * @method Grid\Column|Collection url(string $label = null)
     * @method Grid\Column|Collection length(string $label = null)
     * @method Grid\Column|Collection status(string $label = null)
     * @method Grid\Column|Collection start_time(string $label = null)
     * @method Grid\Column|Collection end_time(string $label = null)
     * @method Grid\Column|Collection describe(string $label = null)
     * @method Grid\Column|Collection deleted_at(string $label = null)
     * @method Grid\Column|Collection driver_type(string $label = null)
     * @method Grid\Column|Collection rule(string $label = null)
     * @method Grid\Column|Collection odds(string $label = null)
     * @method Grid\Column|Collection email(string $label = null)
     * @method Grid\Column|Collection token(string $label = null)
     * @method Grid\Column|Collection tokenable_type(string $label = null)
     * @method Grid\Column|Collection tokenable_id(string $label = null)
     * @method Grid\Column|Collection abilities(string $label = null)
     * @method Grid\Column|Collection last_used_at(string $label = null)
     * @method Grid\Column|Collection expires_at(string $label = null)
     * @method Grid\Column|Collection bpmn_xml(string $label = null)
     * @method Grid\Column|Collection token_id(string $label = null)
     * @method Grid\Column|Collection code_type(string $label = null)
     * @method Grid\Column|Collection lottery_rules(string $label = null)
     * @method Grid\Column|Collection lottery_count_rules(string $label = null)
     * @method Grid\Column|Collection bet_base_amount_rules(string $label = null)
     * @method Grid\Column|Collection bet_total_amount_rules(string $label = null)
     * @method Grid\Column|Collection bet_amount_rules(string $label = null)
     * @method Grid\Column|Collection bet_code_rules(string $label = null)
     * @method Grid\Column|Collection bet_count_rules(string $label = null)
     * @method Grid\Column|Collection win_lose_rules(string $label = null)
     * @method Grid\Column|Collection continuous_lose_count_rules(string $label = null)
     * @method Grid\Column|Collection continuous_win_count_rules(string $label = null)
     * @method Grid\Column|Collection total_amount_rules(string $label = null)
     * @method Grid\Column|Collection request_id(string $label = null)
     * @method Grid\Column|Collection issue(string $label = null)
     * @method Grid\Column|Collection bet_code(string $label = null)
     * @method Grid\Column|Collection bet_code_transform_value(string $label = null)
     * @method Grid\Column|Collection bet_code_odds(string $label = null)
     * @method Grid\Column|Collection lottery_code(string $label = null)
     * @method Grid\Column|Collection bet_amount(string $label = null)
     * @method Grid\Column|Collection bet_total_amount(string $label = null)
     * @method Grid\Column|Collection win_lose(string $label = null)
     * @method Grid\Column|Collection lottery_option_id(string $label = null)
     * @method Grid\Column|Collection email_verified_at(string $label = null)
     */
    class Grid {}

    class MiniGrid extends Grid {}

    /**
     * @property Show\Field|Collection id
     * @property Show\Field|Collection name
     * @property Show\Field|Collection type
     * @property Show\Field|Collection version
     * @property Show\Field|Collection detail
     * @property Show\Field|Collection created_at
     * @property Show\Field|Collection updated_at
     * @property Show\Field|Collection is_enabled
     * @property Show\Field|Collection parent_id
     * @property Show\Field|Collection order
     * @property Show\Field|Collection icon
     * @property Show\Field|Collection uri
     * @property Show\Field|Collection extension
     * @property Show\Field|Collection permission_id
     * @property Show\Field|Collection menu_id
     * @property Show\Field|Collection slug
     * @property Show\Field|Collection http_method
     * @property Show\Field|Collection http_path
     * @property Show\Field|Collection role_id
     * @property Show\Field|Collection user_id
     * @property Show\Field|Collection value
     * @property Show\Field|Collection username
     * @property Show\Field|Collection password
     * @property Show\Field|Collection avatar
     * @property Show\Field|Collection remember_token
     * @property Show\Field|Collection uuid
     * @property Show\Field|Collection connection
     * @property Show\Field|Collection queue
     * @property Show\Field|Collection payload
     * @property Show\Field|Collection exception
     * @property Show\Field|Collection failed_at
     * @property Show\Field|Collection lottery_group_id
     * @property Show\Field|Collection lottery_id
     * @property Show\Field|Collection code
     * @property Show\Field|Collection period
     * @property Show\Field|Collection period_interval
     * @property Show\Field|Collection url
     * @property Show\Field|Collection length
     * @property Show\Field|Collection status
     * @property Show\Field|Collection start_time
     * @property Show\Field|Collection end_time
     * @property Show\Field|Collection describe
     * @property Show\Field|Collection deleted_at
     * @property Show\Field|Collection driver_type
     * @property Show\Field|Collection rule
     * @property Show\Field|Collection odds
     * @property Show\Field|Collection email
     * @property Show\Field|Collection token
     * @property Show\Field|Collection tokenable_type
     * @property Show\Field|Collection tokenable_id
     * @property Show\Field|Collection abilities
     * @property Show\Field|Collection last_used_at
     * @property Show\Field|Collection expires_at
     * @property Show\Field|Collection bpmn_xml
     * @property Show\Field|Collection token_id
     * @property Show\Field|Collection code_type
     * @property Show\Field|Collection lottery_rules
     * @property Show\Field|Collection lottery_count_rules
     * @property Show\Field|Collection bet_base_amount_rules
     * @property Show\Field|Collection bet_total_amount_rules
     * @property Show\Field|Collection bet_amount_rules
     * @property Show\Field|Collection bet_code_rules
     * @property Show\Field|Collection bet_count_rules
     * @property Show\Field|Collection win_lose_rules
     * @property Show\Field|Collection continuous_lose_count_rules
     * @property Show\Field|Collection continuous_win_count_rules
     * @property Show\Field|Collection total_amount_rules
     * @property Show\Field|Collection request_id
     * @property Show\Field|Collection issue
     * @property Show\Field|Collection bet_code
     * @property Show\Field|Collection bet_code_transform_value
     * @property Show\Field|Collection bet_code_odds
     * @property Show\Field|Collection lottery_code
     * @property Show\Field|Collection bet_amount
     * @property Show\Field|Collection bet_total_amount
     * @property Show\Field|Collection win_lose
     * @property Show\Field|Collection lottery_option_id
     * @property Show\Field|Collection email_verified_at
     *
     * @method Show\Field|Collection id(string $label = null)
     * @method Show\Field|Collection name(string $label = null)
     * @method Show\Field|Collection type(string $label = null)
     * @method Show\Field|Collection version(string $label = null)
     * @method Show\Field|Collection detail(string $label = null)
     * @method Show\Field|Collection created_at(string $label = null)
     * @method Show\Field|Collection updated_at(string $label = null)
     * @method Show\Field|Collection is_enabled(string $label = null)
     * @method Show\Field|Collection parent_id(string $label = null)
     * @method Show\Field|Collection order(string $label = null)
     * @method Show\Field|Collection icon(string $label = null)
     * @method Show\Field|Collection uri(string $label = null)
     * @method Show\Field|Collection extension(string $label = null)
     * @method Show\Field|Collection permission_id(string $label = null)
     * @method Show\Field|Collection menu_id(string $label = null)
     * @method Show\Field|Collection slug(string $label = null)
     * @method Show\Field|Collection http_method(string $label = null)
     * @method Show\Field|Collection http_path(string $label = null)
     * @method Show\Field|Collection role_id(string $label = null)
     * @method Show\Field|Collection user_id(string $label = null)
     * @method Show\Field|Collection value(string $label = null)
     * @method Show\Field|Collection username(string $label = null)
     * @method Show\Field|Collection password(string $label = null)
     * @method Show\Field|Collection avatar(string $label = null)
     * @method Show\Field|Collection remember_token(string $label = null)
     * @method Show\Field|Collection uuid(string $label = null)
     * @method Show\Field|Collection connection(string $label = null)
     * @method Show\Field|Collection queue(string $label = null)
     * @method Show\Field|Collection payload(string $label = null)
     * @method Show\Field|Collection exception(string $label = null)
     * @method Show\Field|Collection failed_at(string $label = null)
     * @method Show\Field|Collection lottery_group_id(string $label = null)
     * @method Show\Field|Collection lottery_id(string $label = null)
     * @method Show\Field|Collection code(string $label = null)
     * @method Show\Field|Collection period(string $label = null)
     * @method Show\Field|Collection period_interval(string $label = null)
     * @method Show\Field|Collection url(string $label = null)
     * @method Show\Field|Collection length(string $label = null)
     * @method Show\Field|Collection status(string $label = null)
     * @method Show\Field|Collection start_time(string $label = null)
     * @method Show\Field|Collection end_time(string $label = null)
     * @method Show\Field|Collection describe(string $label = null)
     * @method Show\Field|Collection deleted_at(string $label = null)
     * @method Show\Field|Collection driver_type(string $label = null)
     * @method Show\Field|Collection rule(string $label = null)
     * @method Show\Field|Collection odds(string $label = null)
     * @method Show\Field|Collection email(string $label = null)
     * @method Show\Field|Collection token(string $label = null)
     * @method Show\Field|Collection tokenable_type(string $label = null)
     * @method Show\Field|Collection tokenable_id(string $label = null)
     * @method Show\Field|Collection abilities(string $label = null)
     * @method Show\Field|Collection last_used_at(string $label = null)
     * @method Show\Field|Collection expires_at(string $label = null)
     * @method Show\Field|Collection bpmn_xml(string $label = null)
     * @method Show\Field|Collection token_id(string $label = null)
     * @method Show\Field|Collection code_type(string $label = null)
     * @method Show\Field|Collection lottery_rules(string $label = null)
     * @method Show\Field|Collection lottery_count_rules(string $label = null)
     * @method Show\Field|Collection bet_base_amount_rules(string $label = null)
     * @method Show\Field|Collection bet_total_amount_rules(string $label = null)
     * @method Show\Field|Collection bet_amount_rules(string $label = null)
     * @method Show\Field|Collection bet_code_rules(string $label = null)
     * @method Show\Field|Collection bet_count_rules(string $label = null)
     * @method Show\Field|Collection win_lose_rules(string $label = null)
     * @method Show\Field|Collection continuous_lose_count_rules(string $label = null)
     * @method Show\Field|Collection continuous_win_count_rules(string $label = null)
     * @method Show\Field|Collection total_amount_rules(string $label = null)
     * @method Show\Field|Collection request_id(string $label = null)
     * @method Show\Field|Collection issue(string $label = null)
     * @method Show\Field|Collection bet_code(string $label = null)
     * @method Show\Field|Collection bet_code_transform_value(string $label = null)
     * @method Show\Field|Collection bet_code_odds(string $label = null)
     * @method Show\Field|Collection lottery_code(string $label = null)
     * @method Show\Field|Collection bet_amount(string $label = null)
     * @method Show\Field|Collection bet_total_amount(string $label = null)
     * @method Show\Field|Collection win_lose(string $label = null)
     * @method Show\Field|Collection lottery_option_id(string $label = null)
     * @method Show\Field|Collection email_verified_at(string $label = null)
     */
    class Show {}

    /**
     
     */
    class Form {}

}

namespace Dcat\Admin\Grid {
    /**
     
     */
    class Column {}

    /**
     
     */
    class Filter {}
}

namespace Dcat\Admin\Show {
    /**
     
     */
    class Field {}
}
