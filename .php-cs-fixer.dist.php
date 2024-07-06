<?php

use PhpCsFixer\Finder;
use PhpCsFixer\Config;

$fixers = [
    '@PSR2'                                       => true,
    'array_syntax'                                => ['syntax' => 'short'],
    'binary_operator_spaces'                      => [
        'operators' => [
            '=>' => 'align',
            '='  => 'single_space',
        ],
    ],
    'blank_line_after_namespace'                  => true,
    'blank_line_after_opening_tag'                => true,
    'blank_line_before_statement'                 => ['statements' => ['return']],
    'braces'                                      => true,
    'cast_spaces'                                 => true,
    'concat_space'                                => ['spacing' => 'none'],
    'elseif'                                      => true,
    'encoding'                                    => true,
    'full_opening_tag'                            => true,
    'function_declaration'                        => true,
    'include'                                     => true,
    'indentation_type'                            => true,
    'line_ending'                                 => true,
    'constant_case'                               => ['case' => 'lower'],
    'lowercase_keywords'                          => true,
    'method_argument_space'                       => true,
    'no_alias_functions'                          => true,
    'no_blank_lines_after_class_opening'          => true,
    'no_blank_lines_after_phpdoc'                 => true,
    'no_empty_statement'                          => true,
    'no_leading_import_slash'                     => true,
    'no_leading_namespace_whitespace'             => true,
    'no_multiline_whitespace_around_double_arrow' => true,
    'multiline_whitespace_before_semicolons'      => false,
    'echo_tag_syntax'                             => ['format' => 'long'],
    'no_singleline_whitespace_before_semicolons'  => true,
    'no_spaces_after_function_name'               => true,
    'no_spaces_inside_parenthesis'                => true,
    'no_trailing_comma_in_list_call'              => true,
    'no_trailing_comma_in_singleline_array'       => true,
    'no_trailing_whitespace'                      => true,
    'no_unused_imports'                           => true,
    'no_whitespace_in_blank_line'                 => true,
    'not_operator_with_successor_space'           => false,
    'object_operator_without_whitespace'          => true,
    'ordered_imports'                             => ['sort_algorithm' => 'alpha'],
    'phpdoc_indent'                               => true,
    'general_phpdoc_tag_rename'                   => true,
    'phpdoc_inline_tag_normalizer'                => true,
    'phpdoc_tag_type'                             => true,
    'phpdoc_no_access'                            => true,
    'phpdoc_no_package'                           => true,
    'phpdoc_scalar'                               => true,
    'phpdoc_to_comment'                           => true,
    'phpdoc_trim'                                 => true,
    'phpdoc_var_without_name'                     => false,
    // disabled as this breaks linting in PHPStorm
    'self_accessor'                               => true,
    'simplified_null_return'                      => false,
    // disabled as risky because functions where the response is used
    // and who do not typehint a return of `void`, should always return
    // a value for readability, even though `return null` is implied
    'single_blank_line_at_eof'                    => true,
    'single_blank_line_before_namespace'          => true,
    'single_import_per_statement'                 => true,
    'single_line_after_imports'                   => true,
    'single_quote'                                => true,
    'standardize_not_equals'                      => true,
    'ternary_operator_spaces'                     => true,
    'trailing_comma_in_multiline'                 => ['elements' => ['arrays']],
    'trim_array_spaces'                           => true,
    'unary_operator_spaces'                       => true,
    'visibility_required'                         => true,
    'no_extra_blank_lines'                        => true,
    'phpdoc_no_alias_tag'                         => [
        'replacements' => [
            'type' => 'var',
        ],
    ],
];
$finder = Finder::create()->in(__DIR__)
    ->exclude(['public', 'vendor', 'storage', 'bootstrap', 'nova', 'node_modules'])
    ->notPath('ide_helper.php')
    ->notPath('ide_helper_models.php');

return (new Config())
    ->setFinder($finder)
    ->setRules($fixers)
    ->setRiskyAllowed(true)
    ->setUsingCache(true);
