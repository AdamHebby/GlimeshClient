<?php

namespace GlimeshClient\Tests;

use GlimeshClient\Builder\Builder;
use PHPUnit\Framework\TestCase;
use ReflectionObject;

class BuilderTest extends TestCase
{
    public function testConstruct()
    {
        $builder = new Builder(__DIR__ . '/../../../etc/api.json');

        $this->assertIsArray($builder->schema);
        $this->assertNotEmpty($builder->schema);
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
            if ($type['name'] === 'Follower') {
                $object = $builder->buildObject($type);

                $object = str_replace('class Follower', 'class FollowerTest', $object);

                $rand = uniqid(__FUNCTION__);
                file_put_contents("/tmp/$rand.php", $object);

                require_once("/tmp/$rand.php");

                $ref = new \ReflectionClass('\GlimeshClient\Objects\FollowerTest');

                $this->assertSame('FollowerTest', $ref->getShortName());
                $this->assertCount(8, $ref->getProperties());
            }
        }
    }
}
