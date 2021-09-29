<?php

use PhpCsFixer\{Config, Finder};

$rules = [
    '@PSR2'                       => true,
    'group_import'                => true,
    'align_multiline_comment'     => false,
    'single_import_per_statement' => false,
    'array_indentation'           => true,
    'array_syntax'                => ['syntax' => 'short'],
    'binary_operator_spaces'      => [
        'default'   => 'align_single_space',
        'operators' => ['=>' => 'align_single_space_minimal'],
    ],
    'blank_line_after_namespace'   => true,
    'blank_line_after_opening_tag' => false,
    'blank_line_before_statement'  => ['statements' => ['break', 'continue', 'declare', 'return', 'throw', 'try']],
    'braces'                       => [
        'allow_single_line_closure'                   => false,
        'position_after_anonymous_constructs'         => 'same',
        'position_after_control_structures'           => 'same',
        'position_after_functions_and_oop_constructs' => 'next',
    ],
    'lowercase_cast'              => true,
    'no_short_bool_cast'          => true,
    'cast_spaces'                 => ['space' => 'single'],
    'class_attributes_separation' => ['elements' => ['property' => 'one', 'method' => 'one']],
    'no_unused_imports'           => true,
    'class_keyword_remove'        => false,
    'combine_consecutive_issets'  => false,
    'combine_consecutive_unsets'  => false,
    'combine_nested_dirname'      => false,
    'comment_to_phpdoc'           => false,
    'compact_nullable_typehint'   => false,
    'concat_space'                => ['spacing' => 'one'],
    'date_time_immutable'         => false,
    'declare_equal_normalize'     => [
        'space' => 'single',
    ],
    'declare_strict_types'                 => false,
    'dir_constant'                         => false,
    'doctrine_annotation_array_assignment' => false,
    'doctrine_annotation_braces'           => false,
    'doctrine_annotation_indentation'      => [
        'ignored_tags'       => [],
        'indent_mixed_lines' => true,
    ],
    'doctrine_annotation_spaces' => [
        'after_argument_assignments'     => false,
        'after_array_assignments_colon'  => false,
        'after_array_assignments_equals' => false,
    ],
    'elseif'                                      => false,
    'encoding'                                    => true,
    'indentation_type'                            => true,
    'no_useless_else'                             => true,
    'no_useless_return'                           => true,
    'ordered_imports'                             => true,
    'single_quote'                                => true,
    'ternary_operator_spaces'                     => true,
    'trailing_comma_in_multiline'                 => ['elements' => ['arrays']],
    'no_extra_blank_lines'                        => true,
    'no_multiline_whitespace_around_double_arrow' => true,
    'multiline_whitespace_before_semicolons'      => true,
    'no_singleline_whitespace_before_semicolons'  => true,
    'no_spaces_around_offset'                     => true,
    'ternary_to_null_coalescing'                  => true,
    'whitespace_after_comma_in_array'             => true,
    'trim_array_spaces'                           => true,
    'unary_operator_spaces'                       => true,
    'php_unit_method_casing'                      => false,
];

$finder = Finder::create();

$finder->in([
    __DIR__ . '/config',
    __DIR__ . '/src',
    __DIR__ . '/tests',
]);

return (new Config())
    ->setIndent('    ')
    ->setRiskyAllowed(false)
    ->setRules($rules)
    ->setFinder($finder);
