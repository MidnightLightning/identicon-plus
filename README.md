Identicon Plus
==============
Enhanced version of the Identicon library

The traditional Identicon library uses 64 bits of a 160 bit SHA1 hash to create its image:

* Corner sprite: 4 bits
* Side sprite: 4 bits
* Center sprite: 3 bits
* Corner sprite rotation: 2 bits
* Side sprite rotation: 2 bits
* Center sprite background: 1 bit
* Corner sprite color: 24 bits (8 each for red, green, and blue)
* Side sprite color: 24 bits (8 each for red, green, and blue)

(An optional 8 bits can be used to rotate the final image, but that is seldom used in practice). That leaves over half the bits unused, and using full 24-bit color for the two images means two identicons can have very similar colors that can't be distinguished by the human eye. So a hash doesn't have to match all 72 bits in order to be perceived as identical to another identicon. If matching only the top three bits of each red/green/blue channel, that's only 34 bits of the hash needing to match.

The Identicon Plus library seeks to alleviate this by reducing the number of colors available (palette of 16 colors), forcing an attacker to match more bits to make a perceived match to another identicon.

The Identicon Plus image uses a 4x4 grid instead of 3x3, with the region divided into four 2x2 regions that match (NW with SE, NE with SW). Additionally, more center sprite options are added to increase the number of bits used there, and the blank center option is removed to ensure the center sprite color is shown. The regions have the following properties:

* Corner sprite: 4 bits
* Side sprite: 4 bits
* Center sprite: 3 bits
* Corner sprite color: 4 bits
* Side sprite color: 4 bits
* Center sprite color: 4 bits
* Corner sprite rotation: 2 bits
* Side sprite rotation: 2 bits

For a total of 27 bits for each region pair; total of 54 bits, all of which must be matched in order to make a perceived identical image.

For additional security, each of the four regions can be given their own background color, to add 16 more bits to the image. When using region background colors, if the foreground and the background color match, the foreground color is changed to black (not otherwise a select-able color) to ensure it's visible.