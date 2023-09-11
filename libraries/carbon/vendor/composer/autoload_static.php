<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitbf597c32ebd64ce837fbfd0c59547552
{
    public static $files = array (
        '0e6d7bf4a5811bfa5cf40c5ccd6fae6a' => __DIR__ . '/..' . '/symfony/polyfill-mbstring/bootstrap.php',
        'a4a119a56e50fbb293281d9a48007e0e' => __DIR__ . '/..' . '/symfony/polyfill-php80/bootstrap.php',
    );

    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Symfony\\Polyfill\\Php80\\' => 23,
            'Symfony\\Polyfill\\Mbstring\\' => 26,
            'Symfony\\Contracts\\Translation\\' => 30,
            'Symfony\\Component\\Translation\\' => 30,
        ),
        'P' => 
        array (
            'Psr\\Clock\\' => 10,
        ),
        'C' => 
        array (
            'Carbon\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Symfony\\Polyfill\\Php80\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-php80',
        ),
        'Symfony\\Polyfill\\Mbstring\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-mbstring',
        ),
        'Symfony\\Contracts\\Translation\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/translation-contracts',
        ),
        'Symfony\\Component\\Translation\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/translation',
        ),
        'Psr\\Clock\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/clock/src',
        ),
        'Carbon\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/Carbon',
        ),
    );

    public static $classMap = array (
        'Attribute' => __DIR__ . '/..' . '/symfony/polyfill-php80/Resources/stubs/Attribute.php',
        'Carbon\\AbstractTranslator' => __DIR__ . '/../..' . '/src/Carbon/AbstractTranslator.php',
        'Carbon\\Carbon' => __DIR__ . '/../..' . '/src/Carbon/Carbon.php',
        'Carbon\\CarbonConverterInterface' => __DIR__ . '/../..' . '/src/Carbon/CarbonConverterInterface.php',
        'Carbon\\CarbonImmutable' => __DIR__ . '/../..' . '/src/Carbon/CarbonImmutable.php',
        'Carbon\\CarbonInterface' => __DIR__ . '/../..' . '/src/Carbon/CarbonInterface.php',
        'Carbon\\CarbonInterval' => __DIR__ . '/../..' . '/src/Carbon/CarbonInterval.php',
        'Carbon\\CarbonPeriod' => __DIR__ . '/../..' . '/src/Carbon/CarbonPeriod.php',
        'Carbon\\CarbonPeriodImmutable' => __DIR__ . '/../..' . '/src/Carbon/CarbonPeriodImmutable.php',
        'Carbon\\CarbonTimeZone' => __DIR__ . '/../..' . '/src/Carbon/CarbonTimeZone.php',
        'Carbon\\Cli\\Invoker' => __DIR__ . '/../..' . '/src/Carbon/Cli/Invoker.php',
        'Carbon\\Doctrine\\CarbonDoctrineType' => __DIR__ . '/../..' . '/src/Carbon/Doctrine/CarbonDoctrineType.php',
        'Carbon\\Doctrine\\CarbonImmutableType' => __DIR__ . '/../..' . '/src/Carbon/Doctrine/CarbonImmutableType.php',
        'Carbon\\Doctrine\\CarbonType' => __DIR__ . '/../..' . '/src/Carbon/Doctrine/CarbonType.php',
        'Carbon\\Doctrine\\CarbonTypeConverter' => __DIR__ . '/../..' . '/src/Carbon/Doctrine/CarbonTypeConverter.php',
        'Carbon\\Doctrine\\DateTimeDefaultPrecision' => __DIR__ . '/../..' . '/src/Carbon/Doctrine/DateTimeDefaultPrecision.php',
        'Carbon\\Doctrine\\DateTimeImmutableType' => __DIR__ . '/../..' . '/src/Carbon/Doctrine/DateTimeImmutableType.php',
        'Carbon\\Doctrine\\DateTimeType' => __DIR__ . '/../..' . '/src/Carbon/Doctrine/DateTimeType.php',
        'Carbon\\Exceptions\\BadComparisonUnitException' => __DIR__ . '/../..' . '/src/Carbon/Exceptions/BadComparisonUnitException.php',
        'Carbon\\Exceptions\\BadFluentConstructorException' => __DIR__ . '/../..' . '/src/Carbon/Exceptions/BadFluentConstructorException.php',
        'Carbon\\Exceptions\\BadFluentSetterException' => __DIR__ . '/../..' . '/src/Carbon/Exceptions/BadFluentSetterException.php',
        'Carbon\\Exceptions\\BadMethodCallException' => __DIR__ . '/../..' . '/src/Carbon/Exceptions/BadMethodCallException.php',
        'Carbon\\Exceptions\\EndLessPeriodException' => __DIR__ . '/../..' . '/src/Carbon/Exceptions/EndLessPeriodException.php',
        'Carbon\\Exceptions\\Exception' => __DIR__ . '/../..' . '/src/Carbon/Exceptions/Exception.php',
        'Carbon\\Exceptions\\ImmutableException' => __DIR__ . '/../..' . '/src/Carbon/Exceptions/ImmutableException.php',
        'Carbon\\Exceptions\\InvalidArgumentException' => __DIR__ . '/../..' . '/src/Carbon/Exceptions/InvalidArgumentException.php',
        'Carbon\\Exceptions\\InvalidCastException' => __DIR__ . '/../..' . '/src/Carbon/Exceptions/InvalidCastException.php',
        'Carbon\\Exceptions\\InvalidDateException' => __DIR__ . '/../..' . '/src/Carbon/Exceptions/InvalidDateException.php',
        'Carbon\\Exceptions\\InvalidFormatException' => __DIR__ . '/../..' . '/src/Carbon/Exceptions/InvalidFormatException.php',
        'Carbon\\Exceptions\\InvalidIntervalException' => __DIR__ . '/../..' . '/src/Carbon/Exceptions/InvalidIntervalException.php',
        'Carbon\\Exceptions\\InvalidPeriodDateException' => __DIR__ . '/../..' . '/src/Carbon/Exceptions/InvalidPeriodDateException.php',
        'Carbon\\Exceptions\\InvalidPeriodParameterException' => __DIR__ . '/../..' . '/src/Carbon/Exceptions/InvalidPeriodParameterException.php',
        'Carbon\\Exceptions\\InvalidTimeZoneException' => __DIR__ . '/../..' . '/src/Carbon/Exceptions/InvalidTimeZoneException.php',
        'Carbon\\Exceptions\\InvalidTypeException' => __DIR__ . '/../..' . '/src/Carbon/Exceptions/InvalidTypeException.php',
        'Carbon\\Exceptions\\NotACarbonClassException' => __DIR__ . '/../..' . '/src/Carbon/Exceptions/NotACarbonClassException.php',
        'Carbon\\Exceptions\\NotAPeriodException' => __DIR__ . '/../..' . '/src/Carbon/Exceptions/NotAPeriodException.php',
        'Carbon\\Exceptions\\NotLocaleAwareException' => __DIR__ . '/../..' . '/src/Carbon/Exceptions/NotLocaleAwareException.php',
        'Carbon\\Exceptions\\OutOfRangeException' => __DIR__ . '/../..' . '/src/Carbon/Exceptions/OutOfRangeException.php',
        'Carbon\\Exceptions\\ParseErrorException' => __DIR__ . '/../..' . '/src/Carbon/Exceptions/ParseErrorException.php',
        'Carbon\\Exceptions\\RuntimeException' => __DIR__ . '/../..' . '/src/Carbon/Exceptions/RuntimeException.php',
        'Carbon\\Exceptions\\UnitException' => __DIR__ . '/../..' . '/src/Carbon/Exceptions/UnitException.php',
        'Carbon\\Exceptions\\UnitNotConfiguredException' => __DIR__ . '/../..' . '/src/Carbon/Exceptions/UnitNotConfiguredException.php',
        'Carbon\\Exceptions\\UnknownGetterException' => __DIR__ . '/../..' . '/src/Carbon/Exceptions/UnknownGetterException.php',
        'Carbon\\Exceptions\\UnknownMethodException' => __DIR__ . '/../..' . '/src/Carbon/Exceptions/UnknownMethodException.php',
        'Carbon\\Exceptions\\UnknownSetterException' => __DIR__ . '/../..' . '/src/Carbon/Exceptions/UnknownSetterException.php',
        'Carbon\\Exceptions\\UnknownUnitException' => __DIR__ . '/../..' . '/src/Carbon/Exceptions/UnknownUnitException.php',
        'Carbon\\Exceptions\\UnreachableException' => __DIR__ . '/../..' . '/src/Carbon/Exceptions/UnreachableException.php',
        'Carbon\\Factory' => __DIR__ . '/../..' . '/src/Carbon/Factory.php',
        'Carbon\\FactoryImmutable' => __DIR__ . '/../..' . '/src/Carbon/FactoryImmutable.php',
        'Carbon\\Language' => __DIR__ . '/../..' . '/src/Carbon/Language.php',
        'Carbon\\Laravel\\ServiceProvider' => __DIR__ . '/../..' . '/src/Carbon/Laravel/ServiceProvider.php',
        'Carbon\\MessageFormatter\\MessageFormatterMapper' => __DIR__ . '/../..' . '/src/Carbon/MessageFormatter/MessageFormatterMapper.php',
        'Carbon\\PHPStan\\AbstractMacro' => __DIR__ . '/../..' . '/src/Carbon/PHPStan/AbstractMacro.php',
        'Carbon\\PHPStan\\Macro' => __DIR__ . '/../..' . '/src/Carbon/PHPStan/Macro.php',
        'Carbon\\PHPStan\\MacroExtension' => __DIR__ . '/../..' . '/src/Carbon/PHPStan/MacroExtension.php',
        'Carbon\\PHPStan\\MacroScanner' => __DIR__ . '/../..' . '/src/Carbon/PHPStan/MacroScanner.php',
        'Carbon\\Traits\\Boundaries' => __DIR__ . '/../..' . '/src/Carbon/Traits/Boundaries.php',
        'Carbon\\Traits\\Cast' => __DIR__ . '/../..' . '/src/Carbon/Traits/Cast.php',
        'Carbon\\Traits\\Comparison' => __DIR__ . '/../..' . '/src/Carbon/Traits/Comparison.php',
        'Carbon\\Traits\\Converter' => __DIR__ . '/../..' . '/src/Carbon/Traits/Converter.php',
        'Carbon\\Traits\\Creator' => __DIR__ . '/../..' . '/src/Carbon/Traits/Creator.php',
        'Carbon\\Traits\\Date' => __DIR__ . '/../..' . '/src/Carbon/Traits/Date.php',
        'Carbon\\Traits\\DeprecatedProperties' => __DIR__ . '/../..' . '/src/Carbon/Traits/DeprecatedProperties.php',
        'Carbon\\Traits\\Difference' => __DIR__ . '/../..' . '/src/Carbon/Traits/Difference.php',
        'Carbon\\Traits\\IntervalRounding' => __DIR__ . '/../..' . '/src/Carbon/Traits/IntervalRounding.php',
        'Carbon\\Traits\\IntervalStep' => __DIR__ . '/../..' . '/src/Carbon/Traits/IntervalStep.php',
        'Carbon\\Traits\\Localization' => __DIR__ . '/../..' . '/src/Carbon/Traits/Localization.php',
        'Carbon\\Traits\\Macro' => __DIR__ . '/../..' . '/src/Carbon/Traits/Macro.php',
        'Carbon\\Traits\\MagicParameter' => __DIR__ . '/../..' . '/src/Carbon/Traits/MagicParameter.php',
        'Carbon\\Traits\\Mixin' => __DIR__ . '/../..' . '/src/Carbon/Traits/Mixin.php',
        'Carbon\\Traits\\Modifiers' => __DIR__ . '/../..' . '/src/Carbon/Traits/Modifiers.php',
        'Carbon\\Traits\\Mutability' => __DIR__ . '/../..' . '/src/Carbon/Traits/Mutability.php',
        'Carbon\\Traits\\ObjectInitialisation' => __DIR__ . '/../..' . '/src/Carbon/Traits/ObjectInitialisation.php',
        'Carbon\\Traits\\Options' => __DIR__ . '/../..' . '/src/Carbon/Traits/Options.php',
        'Carbon\\Traits\\Rounding' => __DIR__ . '/../..' . '/src/Carbon/Traits/Rounding.php',
        'Carbon\\Traits\\Serialization' => __DIR__ . '/../..' . '/src/Carbon/Traits/Serialization.php',
        'Carbon\\Traits\\Test' => __DIR__ . '/../..' . '/src/Carbon/Traits/Test.php',
        'Carbon\\Traits\\Timestamp' => __DIR__ . '/../..' . '/src/Carbon/Traits/Timestamp.php',
        'Carbon\\Traits\\ToStringFormat' => __DIR__ . '/../..' . '/src/Carbon/Traits/ToStringFormat.php',
        'Carbon\\Traits\\Units' => __DIR__ . '/../..' . '/src/Carbon/Traits/Units.php',
        'Carbon\\Traits\\Week' => __DIR__ . '/../..' . '/src/Carbon/Traits/Week.php',
        'Carbon\\Translator' => __DIR__ . '/../..' . '/src/Carbon/Translator.php',
        'Carbon\\TranslatorImmutable' => __DIR__ . '/../..' . '/src/Carbon/TranslatorImmutable.php',
        'Carbon\\TranslatorStrongTypeInterface' => __DIR__ . '/../..' . '/src/Carbon/TranslatorStrongTypeInterface.php',
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'PhpToken' => __DIR__ . '/..' . '/symfony/polyfill-php80/Resources/stubs/PhpToken.php',
        'Psr\\Clock\\ClockInterface' => __DIR__ . '/..' . '/psr/clock/src/ClockInterface.php',
        'Stringable' => __DIR__ . '/..' . '/symfony/polyfill-php80/Resources/stubs/Stringable.php',
        'Symfony\\Component\\Translation\\Catalogue\\AbstractOperation' => __DIR__ . '/..' . '/symfony/translation/Catalogue/AbstractOperation.php',
        'Symfony\\Component\\Translation\\Catalogue\\MergeOperation' => __DIR__ . '/..' . '/symfony/translation/Catalogue/MergeOperation.php',
        'Symfony\\Component\\Translation\\Catalogue\\OperationInterface' => __DIR__ . '/..' . '/symfony/translation/Catalogue/OperationInterface.php',
        'Symfony\\Component\\Translation\\Catalogue\\TargetOperation' => __DIR__ . '/..' . '/symfony/translation/Catalogue/TargetOperation.php',
        'Symfony\\Component\\Translation\\Command\\XliffLintCommand' => __DIR__ . '/..' . '/symfony/translation/Command/XliffLintCommand.php',
        'Symfony\\Component\\Translation\\DataCollectorTranslator' => __DIR__ . '/..' . '/symfony/translation/DataCollectorTranslator.php',
        'Symfony\\Component\\Translation\\DataCollector\\TranslationDataCollector' => __DIR__ . '/..' . '/symfony/translation/DataCollector/TranslationDataCollector.php',
        'Symfony\\Component\\Translation\\DependencyInjection\\TranslationDumperPass' => __DIR__ . '/..' . '/symfony/translation/DependencyInjection/TranslationDumperPass.php',
        'Symfony\\Component\\Translation\\DependencyInjection\\TranslationExtractorPass' => __DIR__ . '/..' . '/symfony/translation/DependencyInjection/TranslationExtractorPass.php',
        'Symfony\\Component\\Translation\\DependencyInjection\\TranslatorPass' => __DIR__ . '/..' . '/symfony/translation/DependencyInjection/TranslatorPass.php',
        'Symfony\\Component\\Translation\\DependencyInjection\\TranslatorPathsPass' => __DIR__ . '/..' . '/symfony/translation/DependencyInjection/TranslatorPathsPass.php',
        'Symfony\\Component\\Translation\\Dumper\\CsvFileDumper' => __DIR__ . '/..' . '/symfony/translation/Dumper/CsvFileDumper.php',
        'Symfony\\Component\\Translation\\Dumper\\DumperInterface' => __DIR__ . '/..' . '/symfony/translation/Dumper/DumperInterface.php',
        'Symfony\\Component\\Translation\\Dumper\\FileDumper' => __DIR__ . '/..' . '/symfony/translation/Dumper/FileDumper.php',
        'Symfony\\Component\\Translation\\Dumper\\IcuResFileDumper' => __DIR__ . '/..' . '/symfony/translation/Dumper/IcuResFileDumper.php',
        'Symfony\\Component\\Translation\\Dumper\\IniFileDumper' => __DIR__ . '/..' . '/symfony/translation/Dumper/IniFileDumper.php',
        'Symfony\\Component\\Translation\\Dumper\\JsonFileDumper' => __DIR__ . '/..' . '/symfony/translation/Dumper/JsonFileDumper.php',
        'Symfony\\Component\\Translation\\Dumper\\MoFileDumper' => __DIR__ . '/..' . '/symfony/translation/Dumper/MoFileDumper.php',
        'Symfony\\Component\\Translation\\Dumper\\PhpFileDumper' => __DIR__ . '/..' . '/symfony/translation/Dumper/PhpFileDumper.php',
        'Symfony\\Component\\Translation\\Dumper\\PoFileDumper' => __DIR__ . '/..' . '/symfony/translation/Dumper/PoFileDumper.php',
        'Symfony\\Component\\Translation\\Dumper\\QtFileDumper' => __DIR__ . '/..' . '/symfony/translation/Dumper/QtFileDumper.php',
        'Symfony\\Component\\Translation\\Dumper\\XliffFileDumper' => __DIR__ . '/..' . '/symfony/translation/Dumper/XliffFileDumper.php',
        'Symfony\\Component\\Translation\\Dumper\\YamlFileDumper' => __DIR__ . '/..' . '/symfony/translation/Dumper/YamlFileDumper.php',
        'Symfony\\Component\\Translation\\Exception\\ExceptionInterface' => __DIR__ . '/..' . '/symfony/translation/Exception/ExceptionInterface.php',
        'Symfony\\Component\\Translation\\Exception\\InvalidArgumentException' => __DIR__ . '/..' . '/symfony/translation/Exception/InvalidArgumentException.php',
        'Symfony\\Component\\Translation\\Exception\\InvalidResourceException' => __DIR__ . '/..' . '/symfony/translation/Exception/InvalidResourceException.php',
        'Symfony\\Component\\Translation\\Exception\\LogicException' => __DIR__ . '/..' . '/symfony/translation/Exception/LogicException.php',
        'Symfony\\Component\\Translation\\Exception\\NotFoundResourceException' => __DIR__ . '/..' . '/symfony/translation/Exception/NotFoundResourceException.php',
        'Symfony\\Component\\Translation\\Exception\\RuntimeException' => __DIR__ . '/..' . '/symfony/translation/Exception/RuntimeException.php',
        'Symfony\\Component\\Translation\\Extractor\\AbstractFileExtractor' => __DIR__ . '/..' . '/symfony/translation/Extractor/AbstractFileExtractor.php',
        'Symfony\\Component\\Translation\\Extractor\\ChainExtractor' => __DIR__ . '/..' . '/symfony/translation/Extractor/ChainExtractor.php',
        'Symfony\\Component\\Translation\\Extractor\\ExtractorInterface' => __DIR__ . '/..' . '/symfony/translation/Extractor/ExtractorInterface.php',
        'Symfony\\Component\\Translation\\Extractor\\PhpExtractor' => __DIR__ . '/..' . '/symfony/translation/Extractor/PhpExtractor.php',
        'Symfony\\Component\\Translation\\Extractor\\PhpStringTokenParser' => __DIR__ . '/..' . '/symfony/translation/Extractor/PhpStringTokenParser.php',
        'Symfony\\Component\\Translation\\Formatter\\ChoiceMessageFormatterInterface' => __DIR__ . '/..' . '/symfony/translation/Formatter/ChoiceMessageFormatterInterface.php',
        'Symfony\\Component\\Translation\\Formatter\\IntlFormatter' => __DIR__ . '/..' . '/symfony/translation/Formatter/IntlFormatter.php',
        'Symfony\\Component\\Translation\\Formatter\\IntlFormatterInterface' => __DIR__ . '/..' . '/symfony/translation/Formatter/IntlFormatterInterface.php',
        'Symfony\\Component\\Translation\\Formatter\\MessageFormatter' => __DIR__ . '/..' . '/symfony/translation/Formatter/MessageFormatter.php',
        'Symfony\\Component\\Translation\\Formatter\\MessageFormatterInterface' => __DIR__ . '/..' . '/symfony/translation/Formatter/MessageFormatterInterface.php',
        'Symfony\\Component\\Translation\\IdentityTranslator' => __DIR__ . '/..' . '/symfony/translation/IdentityTranslator.php',
        'Symfony\\Component\\Translation\\Interval' => __DIR__ . '/..' . '/symfony/translation/Interval.php',
        'Symfony\\Component\\Translation\\Loader\\ArrayLoader' => __DIR__ . '/..' . '/symfony/translation/Loader/ArrayLoader.php',
        'Symfony\\Component\\Translation\\Loader\\CsvFileLoader' => __DIR__ . '/..' . '/symfony/translation/Loader/CsvFileLoader.php',
        'Symfony\\Component\\Translation\\Loader\\FileLoader' => __DIR__ . '/..' . '/symfony/translation/Loader/FileLoader.php',
        'Symfony\\Component\\Translation\\Loader\\IcuDatFileLoader' => __DIR__ . '/..' . '/symfony/translation/Loader/IcuDatFileLoader.php',
        'Symfony\\Component\\Translation\\Loader\\IcuResFileLoader' => __DIR__ . '/..' . '/symfony/translation/Loader/IcuResFileLoader.php',
        'Symfony\\Component\\Translation\\Loader\\IniFileLoader' => __DIR__ . '/..' . '/symfony/translation/Loader/IniFileLoader.php',
        'Symfony\\Component\\Translation\\Loader\\JsonFileLoader' => __DIR__ . '/..' . '/symfony/translation/Loader/JsonFileLoader.php',
        'Symfony\\Component\\Translation\\Loader\\LoaderInterface' => __DIR__ . '/..' . '/symfony/translation/Loader/LoaderInterface.php',
        'Symfony\\Component\\Translation\\Loader\\MoFileLoader' => __DIR__ . '/..' . '/symfony/translation/Loader/MoFileLoader.php',
        'Symfony\\Component\\Translation\\Loader\\PhpFileLoader' => __DIR__ . '/..' . '/symfony/translation/Loader/PhpFileLoader.php',
        'Symfony\\Component\\Translation\\Loader\\PoFileLoader' => __DIR__ . '/..' . '/symfony/translation/Loader/PoFileLoader.php',
        'Symfony\\Component\\Translation\\Loader\\QtFileLoader' => __DIR__ . '/..' . '/symfony/translation/Loader/QtFileLoader.php',
        'Symfony\\Component\\Translation\\Loader\\XliffFileLoader' => __DIR__ . '/..' . '/symfony/translation/Loader/XliffFileLoader.php',
        'Symfony\\Component\\Translation\\Loader\\YamlFileLoader' => __DIR__ . '/..' . '/symfony/translation/Loader/YamlFileLoader.php',
        'Symfony\\Component\\Translation\\LoggingTranslator' => __DIR__ . '/..' . '/symfony/translation/LoggingTranslator.php',
        'Symfony\\Component\\Translation\\MessageCatalogue' => __DIR__ . '/..' . '/symfony/translation/MessageCatalogue.php',
        'Symfony\\Component\\Translation\\MessageCatalogueInterface' => __DIR__ . '/..' . '/symfony/translation/MessageCatalogueInterface.php',
        'Symfony\\Component\\Translation\\MessageSelector' => __DIR__ . '/..' . '/symfony/translation/MessageSelector.php',
        'Symfony\\Component\\Translation\\MetadataAwareInterface' => __DIR__ . '/..' . '/symfony/translation/MetadataAwareInterface.php',
        'Symfony\\Component\\Translation\\PluralizationRules' => __DIR__ . '/..' . '/symfony/translation/PluralizationRules.php',
        'Symfony\\Component\\Translation\\Reader\\TranslationReader' => __DIR__ . '/..' . '/symfony/translation/Reader/TranslationReader.php',
        'Symfony\\Component\\Translation\\Reader\\TranslationReaderInterface' => __DIR__ . '/..' . '/symfony/translation/Reader/TranslationReaderInterface.php',
        'Symfony\\Component\\Translation\\Translator' => __DIR__ . '/..' . '/symfony/translation/Translator.php',
        'Symfony\\Component\\Translation\\TranslatorBagInterface' => __DIR__ . '/..' . '/symfony/translation/TranslatorBagInterface.php',
        'Symfony\\Component\\Translation\\TranslatorInterface' => __DIR__ . '/..' . '/symfony/translation/TranslatorInterface.php',
        'Symfony\\Component\\Translation\\Util\\ArrayConverter' => __DIR__ . '/..' . '/symfony/translation/Util/ArrayConverter.php',
        'Symfony\\Component\\Translation\\Util\\XliffUtils' => __DIR__ . '/..' . '/symfony/translation/Util/XliffUtils.php',
        'Symfony\\Component\\Translation\\Writer\\TranslationWriter' => __DIR__ . '/..' . '/symfony/translation/Writer/TranslationWriter.php',
        'Symfony\\Component\\Translation\\Writer\\TranslationWriterInterface' => __DIR__ . '/..' . '/symfony/translation/Writer/TranslationWriterInterface.php',
        'Symfony\\Contracts\\Translation\\LocaleAwareInterface' => __DIR__ . '/..' . '/symfony/translation-contracts/LocaleAwareInterface.php',
        'Symfony\\Contracts\\Translation\\Test\\TranslatorTest' => __DIR__ . '/..' . '/symfony/translation-contracts/Test/TranslatorTest.php',
        'Symfony\\Contracts\\Translation\\TranslatorInterface' => __DIR__ . '/..' . '/symfony/translation-contracts/TranslatorInterface.php',
        'Symfony\\Contracts\\Translation\\TranslatorTrait' => __DIR__ . '/..' . '/symfony/translation-contracts/TranslatorTrait.php',
        'Symfony\\Polyfill\\Mbstring\\Mbstring' => __DIR__ . '/..' . '/symfony/polyfill-mbstring/Mbstring.php',
        'Symfony\\Polyfill\\Php80\\Php80' => __DIR__ . '/..' . '/symfony/polyfill-php80/Php80.php',
        'Symfony\\Polyfill\\Php80\\PhpToken' => __DIR__ . '/..' . '/symfony/polyfill-php80/PhpToken.php',
        'UnhandledMatchError' => __DIR__ . '/..' . '/symfony/polyfill-php80/Resources/stubs/UnhandledMatchError.php',
        'ValueError' => __DIR__ . '/..' . '/symfony/polyfill-php80/Resources/stubs/ValueError.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitbf597c32ebd64ce837fbfd0c59547552::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitbf597c32ebd64ce837fbfd0c59547552::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitbf597c32ebd64ce837fbfd0c59547552::$classMap;

        }, null, ClassLoader::class);
    }
}
