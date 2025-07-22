<?php

/**
 * Returns the appropriate Tailwind CSS classes for a desktop navigation link
 * based on whether the given page name matches the current page.
 *
 * @param string $pageName The name of the page to compare.
 * @return string Tailwind CSS class string for styling the nav link.
 */
function getActiveNavClassDesktop($pageName, $currentPage)
{
    if (!isset($currentPage) || $pageName != $currentPage)
        return 'text-gray-600 text-sm lg:text-base font-medium hover:text-primary transition-colors';
    else
        return 'text-medical-700 text-sm lg:text-base font-medium hover:text-primary transition-colors';
}

/**
 * Returns the appropriate Tailwind CSS classes for a mobile navigation link
 * based on whether the given page name matches the current page.
 *
 * @param string $pageName The name of the page to compare.
 * @return string Tailwind CSS class string for styling the mobile nav link.
 */
function getActiveNavClassMobile($pageName, $currentPage)
{
    if (!isset($currentPage) || $pageName != $currentPage)
        return 'text-gray-600 hover:bg-gray-50 py-2 px-3 rounded-lg text-sm font-medium transition-colors';
    else
        return 'text-medical-700 bg-medical-50 py-2 px-3 rounded-lg text-sm font-medium transition-colors';
}
