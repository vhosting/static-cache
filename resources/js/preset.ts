import { definePreset } from '@primeuix/themes';
import Aura from '@primeuix/themes/aura';

const theme = definePreset(Aura, {
    semantic: {
        primary: {
            50: '#CDE6F8',
            100: '#B2D9F4',
            200: '#7CBEEC',
            300: '#47A3E5',
            400: '#1E87D1',
            500: '#16649B',
            600: '#135685',
            700: '#10476E',
            800: '#0C3958',
            900: '#092A42',
            950: '#082337',
        },
        danger: {
            color: 'hsl(0 62.8% 30.6% / 1)',
            contrastColor: '#ffffff',
        },
        colorScheme: {
            light: {
                primary: {
                    color: '{primary.500}',
                    hoverColor: '{primary.600}',
                    contrastColor: '#ffffff',
                },
                surface: {
                    0: '#ffffff',
                    50: '{neutral.50}',
                    100: '{neutral.100}',
                    200: '{neutral.200}',
                    300: '{neutral.300}',
                    400: '{neutral.400}',
                    500: '{neutral.500}',
                    600: '{neutral.600}',
                    700: '{neutral.700}',
                    800: '{neutral.800}',
                    900: '{neutral.900}',
                    950: '{neutral.950}',
                },
            },
            dark: {
                primary: {
                    color: '{primary.500}',
                    hoverColor: '{primary.600}',
                    contrastColor: '#ffffff',
                },
                surface: {
                    0: '#ffffff',
                    50: '{neutral.50}',
                    100: '{neutral.100}',
                    200: '{neutral.200}',
                    300: '{neutral.300}',
                    400: '{neutral.400}',
                    500: '{neutral.500}',
                    600: '{neutral.600}',
                    700: '{neutral.700}',
                    800: '{neutral.800}',
                    900: '{neutral.900}',
                    950: '{neutral.950}',
                },
            },
        },
    },
    components: {
        button: {
            colorScheme: {
                light: {
                    root: {
                        danger: {
                            background: '{red.800}',
                            hoverBackground: '{red.900}',
                            activeBackground: '{red.900}',
                            borderColor: '{red.800}',
                            hoverBorderColor: '{red.900}',
                            activeBorderColor: '{red.900}',
                            color: '#ffffff',
                            hoverColor: '#ffffff',
                            activeColor: '#ffffff',
                            focusRing: {
                                color: '{red.700}',
                                shadow: 'none',
                            },
                        },
                    },
                },
                dark: {
                    root: {
                        danger: {
                            background: '{red.800}',
                            hoverBackground: '{red.900}',
                            activeBackground: '{red.900}',
                            borderColor: '{red.800}',
                            hoverBorderColor: '{red.900}',
                            activeBorderColor: '{red.900}',
                            color: '#ffffff',
                            hoverColor: '#ffffff',
                            activeColor: '#ffffff',
                            focusRing: {
                                color: '{red.700}',
                                shadow: 'none',
                            },
                        },
                    },
                },
            },
        },
        paginator: {
            colorScheme: {
                light: {
                    navButton: {
                        color: 'black',
                        selectedBackground: '{primary.500}',
                        selectedColor: 'white',
                    },
                },
                dark: {
                    navButton: {
                        color: 'white',
                        selectedBackground: '{primary.500}',
                        selectedColor: 'white',
                    },
                },
            },
        },
        badge: {
            colorScheme: {
                light: {
                    danger: {
                        background: '{red.800}',
                        color: 'white',
                    },
                    success: {
                        background: '{green.700}',
                        color: 'white',
                    },
                },
                dark: {
                    danger: {
                        background: '{red.800}',
                        color: 'white',
                    },
                    success: {
                        background: '{green.700}',
                        color: 'white',
                    },
                },
            },
        },
    },
});

export default theme;
