<?php

declare(strict_types=1);

namespace Huluti\BreadcrumbsBundle\Test;

use Huluti\BreadcrumbsBundle\Model\Breadcrumbs;
use Huluti\BreadcrumbsBundle\Model\SingleBreadcrumb;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 *
 * @coversNothing
 */
final class BreadcrumbsTest extends TestCase
{
    public function testBreadcrumbs(): void
    {
        /** @var Breadcrumbs|SingleBreadcrumb[] $breadcrumbs */
        $breadcrumbs = new Breadcrumbs();
        $breadcrumbs->addItem('FooBar');

        Assert::assertCount(1, $breadcrumbs);
        Assert::assertSame('FooBar', $breadcrumbs[0]->text);

        Assert::assertSame(['default'], $breadcrumbs->getNamespaces());
    }

    public function testNamespaces(): void
    {
        $breadcrumbs = new Breadcrumbs();
        $breadcrumbs->addNamespaceItem('extra', 'FooBarExtra');

        Assert::assertCount(0, $breadcrumbs->getNamespaceBreadcrumbs());

        $breadcrumbItems = $breadcrumbs->getNamespaceBreadcrumbs('extra');
        Assert::assertCount(1, $breadcrumbItems);
        Assert::assertSame('FooBarExtra', $breadcrumbItems[0]->text);

        Assert::assertSame([
            'default',
            'extra',
        ], $breadcrumbs->getNamespaces());
    }

    public function testThrowsExceptionWhenGettingBreadcrumbsFromNonexistentNamespace(): void
    {
        $breadcrumbs = new Breadcrumbs();

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('The breadcrumb namespace "invalid" does not exist');

        $breadcrumbs->getNamespaceBreadcrumbs('invalid');
    }
}
