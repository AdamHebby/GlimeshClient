<?php

namespace GlimeshClient\Tests;

use GlimeshClient\Builder\Builder;
use PHPUnit\Framework\TestCase;
use ReflectionObject;

class BuilderTest extends TestCase
{
    public const DIR = '/tmp/BuilderTest';

    public function testConstruct()
    {
        $builder = new Builder(__DIR__ . '/../../../etc/api.json');

        $this->assertIsArray($builder->schema);
        $this->assertNotEmpty($builder->schema);
    }

    public function setUp(): void
    {
        mkdir(static::DIR);
    }

    protected function tearDown(): void
    {
        // yoink https://stackoverflow.com/questions/7288029/php-delete-directory-that-is-not-empty
        $it = new \RecursiveDirectoryIterator(static::DIR, \FilesystemIterator::SKIP_DOTS);
        $it = new \RecursiveIteratorIterator($it, \RecursiveIteratorIterator::CHILD_FIRST);
        foreach($it as $file) {
            if ($file->isDir()) rmdir($file->getPathname());
            else unlink($file->getPathname());
        }
        rmdir(static::DIR);
    }

    public function testResolveField()
    {
        $this->assertEquals(
            'string',
            Builder::resolveField(json_decode(
                '{
                    "args": [],
                    "deprecationReason": null,
                    "description": "The chat message.",
                    "isDeprecated": false,
                    "name": "message",
                    "type": {
                        "kind": "SCALAR",
                        "name": "String",
                        "ofType": null
                    }
                }',
                true
            ))
        );
        $this->assertEquals(
            'RootMutationType',
            Builder::resolveField(json_decode(
                '{
                    "description": null,
                    "enumValues": null,
                    "fields": [],
                    "inputFields": null,
                    "interfaces": [],
                    "kind": "OBJECT",
                    "name": "RootMutationType",
                    "possibleTypes": null
                }',
                true
            ))
        );
        $this->assertEquals(
            'ChatMessageInput',
            Builder::resolveField(json_decode(
                '{
                    "defaultValue": null,
                    "description": null,
                    "name": "message",
                    "type": {
                        "kind": "NON_NULL",
                        "name": null,
                        "ofType": {
                            "kind": "INPUT_OBJECT",
                            "name": "ChatMessageInput",
                            "ofType": null
                        }
                    }
                }',
                true
            ))
        );

        $this->assertEquals(
            'Channel',
            Builder::resolveField(json_decode(
                '{
                    "args": [],
                    "deprecationReason": null,
                    "description": null,
                    "isDeprecated": false,
                    "name": "channel",
                    "type": {
                        "kind": "NON_NULL",
                        "name": null,
                        "ofType": {
                            "kind": "OBJECT",
                            "name": "Channel",
                            "ofType": null
                        }
                    }
                }',
                true
            ))
        );
        $this->assertEquals(
            '\ArrayObject<StreamMetadata>',
            Builder::resolveField(json_decode(
                '{
                    "args": [],
                    "deprecationReason": null,
                    "description": null,
                    "isDeprecated": false,
                    "name": "metadata",
                    "type": {
                        "kind": "LIST",
                        "name": null,
                        "ofType": {
                            "kind": "OBJECT",
                            "name": "StreamMetadata",
                            "ofType": null
                        }
                    }
                }',
                true
            ))
        );
        $this->assertEquals(
            'int',
            Builder::resolveField(json_decode(
                '{
                    "args": [],
                    "deprecationReason": null,
                    "description": null,
                    "isDeprecated": false,
                    "name": "newSubscribers",
                    "type": {
                        "kind": "SCALAR",
                        "name": "Int",
                        "ofType": null
                    }
                }',
                true
            ))
        );
        $this->assertEquals(
            '\DateTime',
            Builder::resolveField(json_decode(
                '{
                    "args": [],
                    "deprecationReason": null,
                    "description": null,
                    "isDeprecated": false,
                    "name": "startedAt",
                    "type": {
                        "kind": "NON_NULL",
                        "name": null,
                        "ofType": {
                            "kind": "SCALAR",
                            "name": "NaiveDateTime",
                            "ofType": null
                        }
                    }
                }',
                true
            ))
        );
        $this->assertEquals(
            'string',
            Builder::resolveField(json_decode(
                '{
                    "args": [],
                    "deprecationReason": null,
                    "description": null,
                    "isDeprecated": false,
                    "name": "thumbnail",
                    "type": {
                        "kind": "SCALAR",
                        "name": "String",
                        "ofType": null
                    }
                }',
                true
            ))
        );
        $this->assertEquals(
            'string',
            Builder::resolveField(json_decode(
                '{
                    "args": [],
                    "deprecationReason": null,
                    "description": null,
                    "isDeprecated": false,
                    "name": "id",
                    "type": {
                        "kind": "SCALAR",
                        "name": "ID",
                        "ofType": null
                    }
                }',
                true
            ))
        );
        $this->assertEquals(
            'ChannelStatus',
            Builder::resolveField(json_decode(
                '{
                    "args": [],
                    "deprecationReason": null,
                    "description": null,
                    "isDeprecated": false,
                    "name": "status",
                    "type": {
                        "kind": "ENUM",
                        "name": "ChannelStatus",
                        "ofType": null
                    }
                }',
                true
            ))
        );
    }

    /**
     * Name of the category
     *
     * @var
     * @return void
     */
    public function testBuildField()
    {
        $field = '';
        $field .= "    /**\n";
        $field .= "     * Name of the category\n";
        $field .= "     *\n";
        $field .= "     * @var string\n";
        $field .= "     */\n";
        $field .= "    protected \$name;\n";

        $this->assertEquals($field, Builder::buildField(json_decode(
            '{
                "args": [],
                "deprecationReason": null,
                "description": "Name of the category",
                "isDeprecated": false,
                "name": "name",
                "type": {
                    "kind": "SCALAR",
                    "name": "String",
                    "ofType": null
                }
            }',
            true
        )));

        $this->assertNull(Builder::buildField(json_decode(
            '{
                "args": [],
                "deprecationReason": "No reason",
                "description": "Name of the category",
                "isDeprecated": true,
                "name": "name",
                "type": {
                    "kind": "SCALAR",
                    "name": "String",
                    "ofType": null
                }
            }',
            true
        )));

        $field = '';
        $field .= "    /**\n";
        $field .= "     * Description not provided\n";
        $field .= "     *\n";
        $field .= "     * @var \\ArrayObject<Subcategory>\n";
        $field .= "     */\n";
        $field .= "    protected \$subcategories;\n";

        $this->assertEquals($field, Builder::buildField(json_decode(
            '{
                "args": [],
                "deprecationReason": null,
                "description": null,
                "isDeprecated": false,
                "name": "subcategories",
                "type": {
                    "kind": "LIST",
                    "name": null,
                    "ofType": {
                        "kind": "OBJECT",
                        "name": "Subcategory",
                        "ofType": null
                    }
                }
            }',
            true
        )));

        $field = '';
        $field .= "    /**\n";
        $field .= "     * Description not provided\n";
        $field .= "     *\n";
        $field .= "     * @var Category\n";
        $field .= "     */\n";
        $field .= "    protected \$category;\n";

        $this->assertEquals($field, Builder::buildField(json_decode(
            '{
                "args": [],
                "deprecationReason": null,
                "description": null,
                "isDeprecated": false,
                "name": "category",
                "type": {
                    "kind": "NON_NULL",
                    "name": null,
                    "ofType": {
                        "kind": "OBJECT",
                        "name": "Category",
                        "ofType": null
                    }
                }
            }',
            true
        )));

        $field = '';
        $field .= "    /**\n";
        $field .= "     * Description not provided\n";
        $field .= "     *\n";
        $field .= "     * @var ChannelStatus\n";
        $field .= "     */\n";
        $field .= "    protected \$status;\n";

        $this->assertEquals($field, Builder::buildField(json_decode(
            '{
                "args": [],
                "deprecationReason": null,
                "description": null,
                "isDeprecated": false,
                "name": "status",
                "type": {
                    "kind": "ENUM",
                    "name": "ChannelStatus",
                    "ofType": null
                }
            }',
            true
        )));
    }

    public function testBuiltObject()
    {
        $builder = new Builder(__DIR__ . '/../../../etc/api.json');

        foreach ($builder->schema as $type) {
            if ($type['name'] === 'EmoteToken') {
                $object = Builder::buildObject($type);

                $object = str_replace('class EmoteToken', 'class EmoteTokenTest', $object);

                $rand = uniqid(__FUNCTION__);
                file_put_contents(static::DIR . "/$rand.php", $object);

                require_once(static::DIR . "/$rand.php");

                $ref = new \ReflectionClass('\GlimeshClient\Objects\EmoteTokenTest');

                $this->assertSame('EmoteTokenTest', $ref->getShortName());
                $this->assertCount(6, $ref->getProperties());
            }
        }
    }

    public function testBuiltInputObject()
    {
        $builder = new Builder(__DIR__ . '/../../../etc/api.json');

        foreach ($builder->schema as $type) {
            if ($type['name'] === 'ChatMessageInput') {
                $object = Builder::buildInputObject($type);

                $object = str_replace('class ChatMessageInput', 'class ChatMessageInputTest', $object);

                $rand = uniqid(__FUNCTION__);
                file_put_contents(static::DIR . "/$rand.php", $object);

                require_once(static::DIR . "/$rand.php");

                $ref = new \ReflectionClass('\GlimeshClient\Objects\Input\ChatMessageInputTest');

                $this->assertSame('ChatMessageInputTest', $ref->getShortName());
                $this->assertCount(3, $ref->getProperties());
            }
        }
    }
    public function testBuiltInterface()
    {
        $builder = new Builder(__DIR__ . '/../../../etc/api.json');

        $cmt = [];
        $et = [];
        foreach ($builder->schema as $type) {
            if ($type['name'] === 'ChatMessageToken') {
                $cmt = $type;
            }
            if ($type['name'] === 'EmoteToken') {
                $et = $type;
            }
        }

        $interface = Builder::buildInterface($cmt);

        $interface = str_replace('interface ChatMessageToken', 'interface ChatMessageTokenTest', $interface);

        $randInterface = uniqid(__FUNCTION__);
        file_put_contents(static::DIR . "/$randInterface.php", $interface);

        require_once(static::DIR . "/$randInterface.php");


        $object = Builder::buildObject($et);

        $object = str_replace('class EmoteToken', 'class EmoteTokenTestTwo', $object);
        $object = str_replace('ChatMessageToken', 'ChatMessageTokenTest', $object);

        $rand = uniqid(__FUNCTION__);
        file_put_contents(static::DIR . "/$rand.php", $object);

        require_once(static::DIR . "/$rand.php");

        $ref = new \ReflectionClass('\GlimeshClient\Objects\EmoteTokenTestTwo');

        $this->assertSame('EmoteTokenTestTwo', $ref->getShortName());
        $this->assertCount(6, $ref->getProperties());
    }


    public function testBuiltEnumObject()
    {
        $builder = new Builder(__DIR__ . '/../../../etc/api.json');

        foreach ($builder->schema as $type) {
            if ($type['name'] === 'ChannelStatus') {
                $object = Builder::buildENUM($type);

                $object = str_replace('class ChannelStatus', 'class ChannelStatusTest', $object);

                $rand = uniqid(__FUNCTION__);
                file_put_contents(static::DIR . "/$rand.php", $object);

                require_once(static::DIR . "/$rand.php");

                $ref = new \ReflectionClass('\GlimeshClient\Objects\Enums\ChannelStatusTest');

                $this->assertSame('ChannelStatusTest', $ref->getShortName());
                $this->assertCount(3, $ref->getProperties());
            }
        }
    }

    public function testBuildFull()
    {
        $builder = new Builder(__DIR__ . '/../../../etc/api.json');

        $builder->paths = [
            'INTERFACE'     => '/tmp/BuilderTest',
            'OBJECT'        => '/tmp/BuilderTest',
            'INPUT_OBJECT'  => '/tmp/BuilderTest',
            'ENUM'          => '/tmp/BuilderTest',
        ];

        $builder->build();
        $paths = [];

        $it = new \RecursiveDirectoryIterator(static::DIR, \FilesystemIterator::SKIP_DOTS);
        $it = new \RecursiveIteratorIterator($it, \RecursiveIteratorIterator::CHILD_FIRST);
        foreach($it as $file) {
            if (!$file->isDir()) $paths[] = $file->getPathname();
        }

        sort($paths);

        $this->assertEquals([
            static::DIR . '/Category.php',
            static::DIR . '/Channel.php',
            static::DIR . '/ChannelBan.php',
            static::DIR . '/ChannelModerationLog.php',
            static::DIR . '/ChannelModerator.php',
            static::DIR . '/ChannelStatus.php',
            static::DIR . '/ChatMessage.php',
            static::DIR . '/ChatMessageInput.php',
            static::DIR . '/ChatMessageToken.php',
            static::DIR . '/ChatMessageToken/EmoteToken.php',
            static::DIR . '/ChatMessageToken/TextToken.php',
            static::DIR . '/ChatMessageToken/UrlToken.php',
            static::DIR . '/Follower.php',
            static::DIR . '/RootMutationType.php',
            static::DIR . '/RootQueryType.php',
            static::DIR . '/RootSubscriptionType.php',
            static::DIR . '/Stream.php',
            static::DIR . '/StreamMetadata.php',
            static::DIR . '/StreamMetadataInput.php',
            static::DIR . '/Sub.php',
            static::DIR . '/Subcategory.php',
            static::DIR . '/Tag.php',
            static::DIR . '/User.php',
            static::DIR . '/UserSocial.php',
        ], array_values($paths));
    }
}
