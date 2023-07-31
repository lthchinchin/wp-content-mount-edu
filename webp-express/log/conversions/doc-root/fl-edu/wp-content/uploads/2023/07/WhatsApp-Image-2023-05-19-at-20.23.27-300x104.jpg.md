WebP Express 0.25.6. Conversion triggered with the conversion script (wod/webp-on-demand.php), 2023-07-24 12:13:47

**WebP Convert 2.9.0 ignited** 
PHP version: 7.4.30
Server software: Apache/2.4.54 (Win64) OpenSSL/1.1.1p PHP/7.4.30

source: [doc-root]/fl-edu/wp-content/uploads/2023/07/WhatsApp-Image-2023-05-19-at-20.23.27-300x104.jpg
destination: C:\xampp\htdocs\fl-edu\wp-content\webp-express/webp-images/uploads/2023\07\WhatsApp-Image-2023-05-19-at-20.23.27-300x104.jpg.webp

**Stack converter ignited** 

Options:
------------
- encoding: "auto"
- quality: 70
- near-lossless: 60
- metadata: "none"
- log-call-arguments: true
- converters: (array of 10 items)

Note that these are the resulting options after merging down the "jpeg" and "png" options and any converter-prefixed options

Defaults:
------------
The following options was not set, so using the following defaults:
- auto-limit: true
- converter-options: (empty array)
- preferred-converters: (empty array)
- extra-converters: (empty array)
- shuffle: false


**cwebp converter ignited** 

Options:
------------
- encoding: "auto"
- quality: 70
- near-lossless: 60
- metadata: "none"
- method: 6
- low-memory: true
- log-call-arguments: true
- use-nice: true
- try-common-system-paths: true
- try-supplied-binary-for-os: true
- command-line-options: ""

Note that these are the resulting options after merging down the "jpeg" and "png" options and any converter-prefixed options

Defaults:
------------
The following options was not set, so using the following defaults:
- auto-limit: true
- alpha-quality: 85
- sharp-yuv: true
- auto-filter: false
- preset: "none"
- size-in-percentage: null (not set)
- try-cwebp: true
- try-discovering-cwebp: true
- skip-these-precompiled-binaries: ""
- rel-path-to-precompiled-binaries: *****

Encoding is set to auto - converting to both lossless and lossy and selecting the smallest file

Converting to lossy
Looking for cwebp binaries.
Discovering if a plain cwebp call works (to skip this step, disable the "try-cwebp" option)
- Executing: cwebp -version 2>&1. Result: *Exec failed* (return code: 1)

*Output:* 
'cwebp' is not recognized as an internal or external command,
operable program or batch file.

Nope a plain cwebp call does not work (spent 33 ms)
Discovering binaries using "which -a cwebp" command. (to skip this step, disable the "try-discovering-cwebp" option)
Found 0 binaries (spent 91 ms)
Discovering binaries by peeking in common system paths (to skip this step, disable the "try-common-system-paths" option)
Found 0 binaries (spent 1 ms)
Discovering binaries which are distributed with the webp-convert library (to skip this step, disable the "try-supplied-binary-for-os" option)
Checking if we have a supplied precompiled binary for your OS (WINNT)... We do. We in fact have 2
Found 2 binaries (spent 1 ms)
- C:\xampp\htdocs\fl-edu\wp-content\plugins\webp-express\vendor\rosell-dk\webp-convert\src\Convert\Converters\Binaries\cwebp-120-windows-x64.exe
- C:\xampp\htdocs\fl-edu\wp-content\plugins\webp-express\vendor\rosell-dk\webp-convert\src\Convert\Converters\Binaries\cwebp-110-windows-x64.exe
Discovering cwebp binaries took: 126 ms

Binaries ordered by version number.
- C:\xampp\htdocs\fl-edu\wp-content\plugins\webp-express\vendor\rosell-dk\webp-convert\src\Convert\Converters\Binaries\cwebp-120-windows-x64.exe: (version: 1.2.0)
- C:\xampp\htdocs\fl-edu\wp-content\plugins\webp-express\vendor\rosell-dk\webp-convert\src\Convert\Converters\Binaries\cwebp-110-windows-x64.exe: (version: 1.1.0)
Starting conversion, using the first of these. If that should fail, the next will be tried and so on.
**No "nice" support. To save a few ms, you can disable the "use-nice" option.**
Checking checksum for supplied binary: C:\xampp\htdocs\fl-edu\wp-content\plugins\webp-express\vendor\rosell-dk\webp-convert\src\Convert\Converters\Binaries\cwebp-120-windows-x64.exe
Checksum test took: 5 ms
Creating command line options for version: 1.2.0
Running auto-limit
Quality setting: 70. 
Quality of source image could not be established (Imagick or GraphicsMagick is required). Sorry, no auto-limit functionality for you. 
Using supplied quality (70).
The near-lossless option ignored for lossy
Trying to convert by executing the following command:
C:\xampp\htdocs\fl-edu\wp-content\plugins\webp-express\vendor\rosell-dk\webp-convert\src\Convert\Converters\Binaries\cwebp-120-windows-x64.exe -metadata none -q 70 -alpha_q "85" -sharp_yuv -m 6 -low_memory "[doc-root]/fl-edu/wp-content/uploads/2023/07/WhatsApp-Image-2023-05-19-at-20.23.27-300x104.jpg" -o "C:\xampp\htdocs\fl-edu\wp-content\webp-express/webp-images/uploads/2023\07\WhatsApp-Image-2023-05-19-at-20.23.27-300x104.jpg.webp.lossy.webp" 2>&1

*Output:* 
Saving file 'C:\xampp\htdocs\fl-edu\wp-content\webp-express/webp-images/uploads/2023\07\WhatsApp-Image-2023-05-19-at-20.23.27-300x104.jpg.webp.lossy.webp'
File:      [doc-root]/fl-edu/wp-content/uploads/2023/07/WhatsApp-Image-2023-05-19-at-20.23.27-300x104.jpg
Dimension: 300 x 104
Output:    4854 bytes Y-U-V-All-PSNR 37.90 38.80 38.98   38.21 dB
           (1.24 bpp)
block count:  intra4:        117  (87.97%)
              intra16:        16  (12.03%)
              skipped:         0  (0.00%)
bytes used:  header:             97  (2.0%)
             mode-partition:    560  (11.5%)
 Residuals bytes  |segment 1|segment 2|segment 3|segment 4|  total
  intra4-coeffs:  |     393 |     964 |    1096 |     360 |    2813  (58.0%)
 intra16-coeffs:  |       0 |       0 |       4 |      62 |      66  (1.4%)
  chroma coeffs:  |     200 |     398 |     494 |     198 |    1290  (26.6%)
    macroblocks:  |       7%|      21%|      40%|      32%|     133
      quantizer:  |      39 |      33 |      28 |      21 |
   filter level:  |      11 |       7 |       5 |       9 |
------------------+---------+---------+---------+---------+-----------------
 segments total:  |     593 |    1362 |    1594 |     620 |    4169  (85.9%)

Executing cwebp binary took: 76 ms

Success
Reduction: 42% (went from 8327 bytes to 4854 bytes)

Converting to lossless
Looking for cwebp binaries.
Discovering if a plain cwebp call works (to skip this step, disable the "try-cwebp" option)
- Executing: cwebp -version 2>&1. Result: *Exec failed* (return code: 1)

*Output:* 
'cwebp' is not recognized as an internal or external command,
operable program or batch file.

Nope a plain cwebp call does not work (spent 30 ms)
Discovering binaries using "which -a cwebp" command. (to skip this step, disable the "try-discovering-cwebp" option)
Found 0 binaries (spent 77 ms)
Discovering binaries by peeking in common system paths (to skip this step, disable the "try-common-system-paths" option)
Found 0 binaries (spent 0 ms)
Discovering binaries which are distributed with the webp-convert library (to skip this step, disable the "try-supplied-binary-for-os" option)
Checking if we have a supplied precompiled binary for your OS (WINNT)... We do. We in fact have 2
Found 2 binaries (spent 0 ms)
- C:\xampp\htdocs\fl-edu\wp-content\plugins\webp-express\vendor\rosell-dk\webp-convert\src\Convert\Converters\Binaries\cwebp-120-windows-x64.exe
- C:\xampp\htdocs\fl-edu\wp-content\plugins\webp-express\vendor\rosell-dk\webp-convert\src\Convert\Converters\Binaries\cwebp-110-windows-x64.exe
Discovering cwebp binaries took: 107 ms

Binaries ordered by version number.
- C:\xampp\htdocs\fl-edu\wp-content\plugins\webp-express\vendor\rosell-dk\webp-convert\src\Convert\Converters\Binaries\cwebp-120-windows-x64.exe: (version: 1.2.0)
- C:\xampp\htdocs\fl-edu\wp-content\plugins\webp-express\vendor\rosell-dk\webp-convert\src\Convert\Converters\Binaries\cwebp-110-windows-x64.exe: (version: 1.1.0)
Starting conversion, using the first of these. If that should fail, the next will be tried and so on.
**No "nice" support. To save a few ms, you can disable the "use-nice" option.**
Checking checksum for supplied binary: C:\xampp\htdocs\fl-edu\wp-content\plugins\webp-express\vendor\rosell-dk\webp-convert\src\Convert\Converters\Binaries\cwebp-120-windows-x64.exe
Checksum test took: 4 ms
Creating command line options for version: 1.2.0
Trying to convert by executing the following command:
C:\xampp\htdocs\fl-edu\wp-content\plugins\webp-express\vendor\rosell-dk\webp-convert\src\Convert\Converters\Binaries\cwebp-120-windows-x64.exe -metadata none -q 70 -alpha_q "85" -near_lossless 60 -sharp_yuv -m 6 -low_memory "[doc-root]/fl-edu/wp-content/uploads/2023/07/WhatsApp-Image-2023-05-19-at-20.23.27-300x104.jpg" -o "C:\xampp\htdocs\fl-edu\wp-content\webp-express/webp-images/uploads/2023\07\WhatsApp-Image-2023-05-19-at-20.23.27-300x104.jpg.webp.lossless.webp" 2>&1

*Output:* 
Saving file 'C:\xampp\htdocs\fl-edu\wp-content\webp-express/webp-images/uploads/2023\07\WhatsApp-Image-2023-05-19-at-20.23.27-300x104.jpg.webp.lossless.webp'
File:      [doc-root]/fl-edu/wp-content/uploads/2023/07/WhatsApp-Image-2023-05-19-at-20.23.27-300x104.jpg
Dimension: 300 x 104
Output:    26690 bytes (6.84 bpp)
Lossless-ARGB compressed size: 26690 bytes
  * Header size: 2262 bytes, image data size: 24402
  * Lossless features used: PREDICTION CROSS-COLOR-TRANSFORM SUBTRACT-GREEN
  * Precision Bits: histogram=2 transform=2 cache=0

Executing cwebp binary took: 195 ms

Success
Reduction: -221% (went from 8327 bytes to 26690 bytes)

Picking lossy
cwebp succeeded :)

Converted image in 713 ms, reducing file size with 42% (went from 8327 bytes to 4854 bytes)
