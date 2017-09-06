# Magento 2 Widget Extra Fields

Magento 2 module to add extra field types on widgets

## Installation

```
$ composer require "staempfli/magento2-module-widget-extra-fields":"~1.0"
```

## Usage

### ImageField

Use `Staempfli\WidgetExtraFields\Block\Adminhtml\ImageField` as `block` type in your widget parameter

```
<widget id="<widget_id>" class="Vendor\Module\Block\Widget\<Your_Widget>" >
    <label translate="true">Widget Name</label>
    <description>Widget Description</description>
    <parameters>
        <parameter name="image" xsi:type="block" visible="true" sort_order="100" required="true">
            <label translate="true">Image</label>
            <block class="Staempfli\WidgetExtraFields\Block\Adminhtml\ImageField"/>
        </parameter>
    </parameters>
</widget>
```

![image alt](docs/img/image-field.png)

## Prerequisites

- PHP >= 7.0.*
- Magento >= 2.1.*

## Developers

Staempfli Webteam, and all other [contributors](https://github.com/staempfli/magento2-module-chat-connector/contributors)

## License

[Open Software License ("OSL") v. 3.0](https://opensource.org/licenses/OSL-3.0)

## Copyright

(c) 2017, Stämpfli AG
