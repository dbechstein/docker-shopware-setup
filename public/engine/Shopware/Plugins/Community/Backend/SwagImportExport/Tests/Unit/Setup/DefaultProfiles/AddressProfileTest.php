<?php
/**
 * (c) shopware AG <info@shopware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SwagImportExport\Unit\Setup\DefaultProfiles;

use Shopware\Setup\SwagImportExport\DefaultProfiles\AddressProfile;
use Shopware\Setup\SwagImportExport\DefaultProfiles\ProfileMetaData;
use SwagImportExport\Tests\Unit\Setup\DefaultProfiles\DefaultProfileTestCaseTrait;

class AddressProfileTest extends \PHPUnit_Framework_TestCase
{
    use DefaultProfileTestCaseTrait;

    public function test_it_can_be_created()
    {
        $addressProfile = new AddressProfile();
        $this->assertInstanceOf(AddressProfile::class, $addressProfile);
        $this->assertInstanceOf(ProfileMetaData::class, $addressProfile);
        $this->assertInstanceOf(\JsonSerializable::class, $addressProfile);
    }

    public function test_it_should_return_valid_profile_tree()
    {
        $addressProfile = new AddressProfile();

        $profileTree = $addressProfile->jsonSerialize();
        $this->walkRecursive($profileTree, function ($node) {
            $this->assertArrayHasKey('id', $node, "Current array: " . print_r($node, true));
            $this->assertArrayHasKey('type', $node, "Current array: " . print_r($node, true));
            $this->assertArrayHasKey('name', $node, "Current array: " . print_r($node, true));
        });


        $profileJson = json_encode($addressProfile);
        $this->assertJson($profileJson);
    }
}
