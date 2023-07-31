WebP Express 0.25.6. Conversion triggered using bulk conversion, 2023-07-24 09:19:32

**WebP Convert 2.9.0 ignited** 
PHP version: 7.4.30
Server software: Apache/2.4.54 (Win64) OpenSSL/1.1.1p PHP/7.4.30

source: C:\xampp\htdocs\fl-edu/wp-content/uploads/2023/07/Royal-Enfield-Himalayan-Camo-8-300x300.jpg
destination: C:\xampp\htdocs\fl-edu/wp-content/webp-express/webp-images/uploads/2023\07\Royal-Enfield-Himalayan-Camo-8-300x300.jpg.webp

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

Nope a plain cwebp call does not work (spent 27 ms)
Discovering binaries using "which -a cwebp" command. (to skip this step, disable the "try-discovering-cwebp" option)
Found 0 binaries (spent 61 ms)
Discovering binaries by peeking in common system paths (to skip this step, disable the "try-common-system-paths" option)
Found 0 binaries (spent 0 ms)
Discovering binaries which are distributed with the webp-convert library (to skip this step, disable the "try-supplied-binary-for-os" option)
Checking if we have a supplied precompiled binary for your OS (WINNT)... We do. We in fact have 2
Found 2 binaries (spent 1 ms)
- C:\xampp\htdocs\fl-edu\wp-content\plugins\webp-express\vendor\rosell-dk\webp-convert\src\Convert\Converters\Binaries\cwebp-120-windows-x64.exe
- C:\xampp\htdocs\fl-edu\wp-content\plugins\webp-express\vendor\rosell-dk\webp-convert\src\Convert\Converters\Binaries\cwebp-110-windows-x64.exe
Discovering cwebp binaries took: 89 ms

Binaries ordered by version number.
- C:\xampp\htdocs\fl-edu\wp-content\plugins\webp-express\vendor\rosell-dk\webp-convert\src\Convert\Converters\Binaries\cwebp-120-windows-x64.exe: (version: 1.2.0)
- C:\xampp\htdocs\fl-edu\wp-content\plugins\webp-express\vendor\rosell-dk\webp-convert\src\Convert\Converters\Binaries\cwebp-110-windows-x64.exe: (version: 1.1.0)
Starting conversion, using the first of these. If that should fail, the next will be tried and so on.
**No "nice" support. To save a few ms, you can disable the "use-nice" option.**
Checking checksum for supplied binary: C:\xampp\htdocs\fl-edu\wp-content\plugins\webp-express\vendor\rosell-dk\webp-convert\src\Convert\Converters\Binaries\cwebp-120-windows-x64.exe
Checksum test took: 11 ms
Creating command line options for version: 1.2.0
Running auto-limit
Quality setting: 70. 
Quality of source image could not be established (Imagick or GraphicsMagick is required). Sorry, no auto-limit functionality for you. 
Using supplied quality (70).
The near-lossless option ignored for lossy
Trying to convert by executing the following command:
C:\xampp\htdocs\fl-edu\wp-content\plugins\webp-express\vendor\rosell-dk\webp-convert\src\Convert\Converters\Binaries\cwebp-120-windows-x64.exe -metadata none -q 70 -alpha_q "85" -sharp_yuv -m 6 -low_memory "C:\xampp\htdocs\fl-edu/wp-content/uploads/2023/07/Royal-Enfield-Himalayan-Camo-8-300x300.jpg" -o "C:\xampp\htdocs\fl-edu/wp-content/webp-express/webp-images/uploads/2023\07\Royal-Enfield-Himalayan-Camo-8-300x300.jpg.webp.lossy.webp" 2>&1

*Output:* 
Saving file 'C:\xampp\htdocs\fl-edu/wp-content/webp-express/webp-images/uploads/2023\07\Royal-Enfield-Himalayan-Camo-8-300x300.jpg.webp.lossy.webp'
File:      C:\xampp\htdocs\fl-edu/wp-content/uploads/2023/07/Royal-Enfield-Himalayan-Camo-8-300x300.jpg
Dimension: 300 x 300
Output:    16744 bytes Y-U-V-All-PSNR 36.62 42.43 43.27   37.89 dB
           (1.49 bpp)
block count:  intra4:        348  (96.40%)
              intra16:        13  (3.60%)
              skipped:         0  (0.00%)
bytes used:  header:            125  (0.7%)
             mode-partition:   1856  (11.1%)
 Residuals bytes  |segment 1|segment 2|segment 3|segment 4|  total
  intra4-coeffs:  |     991 |    4374 |    7374 |     578 |   13317  (79.5%)
 intra16-coeffs:  |       0 |       0 |      29 |      70 |      99  (0.6%)
  chroma coeffs:  |      66 |     526 |     660 |      65 |    1317  (7.9%)
    macroblocks:  |       5%|      26%|      58%|      11%|     361
      quantizer:  |      39 |      33 |      26 |      19 |
   filter level:  |      11 |       7 |       4 |      13 |
------------------+---------+---------+---------+---------+-----------------
 segments total:  |    1057 |    4900 |    8063 |     713 |   14733  (88.0%)

Executing cwebp binary took: 78 ms

Success
Reduction: 39% (went from 27 kb to 16 kb)

Converting to lossless
Looking for cwebp binaries.
Discovering if a plain cwebp call works (to skip this step, disable the "try-cwebp" option)
- Executing: cwebp -version 2>&1. Result: *Exec failed* (return code: 1)

*Output:* 
'cwebp' is not recognized as an internal or external command,
operable program or batch file.

Nope a plain cwebp call does not work (spent 30 ms)
Discovering binaries using "which -a cwebp" command. (to skip this step, disable the "try-discovering-cwebp" option)
Found 0 binaries (spent 61 ms)
Discovering binaries by peeking in common system paths (to skip this step, disable the "try-common-system-paths" option)
Found 0 binaries (spent 0 ms)
Discovering binaries which are distributed with the webp-convert library (to skip this step, disable the "try-supplied-binary-for-os" option)
Checking if we have a supplied precompiled binary for your OS (WINNT)... We do. We in fact have 2
Found 2 binaries (spent 0 ms)
- C:\xampp\htdocs\fl-edu\wp-content\plugins\webp-express\vendor\rosell-dk\webp-convert\src\Convert\Converters\Binaries\cwebp-120-windows-x64.exe
- C:\xampp\htdocs\fl-edu\wp-content\plugins\webp-express\vendor\rosell-dk\webp-convert\src\Convert\Converters\Binaries\cwebp-110-windows-x64.exe
Discovering cwebp binaries took: 91 ms

Binaries ordered by version number.
- C:\xampp\htdocs\fl-edu\wp-content\plugins\webp-express\vendor\rosell-dk\webp-convert\src\Convert\Converters\Binaries\cwebp-120-windows-x64.exe: (version: 1.2.0)
- C:\xampp\htdocs\fl-edu\wp-content\plugins\webp-express\vendor\rosell-dk\webp-convert\src\Convert\Converters\Binaries\cwebp-110-windows-x64.exe: (version: 1.1.0)
Starting conversion, using the first of these. If that should fail, the next will be tried and so on.
**No "nice" support. To save a few ms, you can disable the "use-nice" option.**
Checking checksum for supplied binary: C:\xampp\htdocs\fl-edu\wp-content\plugins\webp-express\vendor\rosell-dk\webp-convert\src\Convert\Converters\Binaries\cwebp-120-windows-x64.exe
Checksum test took: 3 ms
Creating command line options for version: 1.2.0
Trying to convert by executing the following command:
C:\xampp\htdocs\fl-edu\wp-content\plugins\webp-express\vendor\rosell-dk\webp-convert\src\Convert\Converters\Binaries\cwebp-120-windows-x64.exe -metadata none -q 70 -alpha_q "85" -near_lossless 60 -sharp_yuv -m 6 -low_memory "C:\xampp\htdocs\fl-edu/wp-content/uploads/2023/07/Royal-Enfield-Himalayan-Camo-8-300x300.jpg" -o "C:\xampp\htdocs\fl-edu/wp-content/webp-express/webp-images/uploads/2023\07\Royal-Enfield-Himalayan-Camo-8-300x300.jpg.webp.lossless.webp" 2>&1

*Output:* 
Saving file 'C:\xampp\htdocs\fl-edu/wp-content/webp-express/webp-images/uploads/2023\07\Royal-Enfield-Himalayan-Camo-8-300x300.jpg.webp.lossless.webp'
File:      C:\xampp\htdocs\fl-edu/wp-content/uploads/2023/07/Royal-Enfield-Himalayan-Camo-8-300x300.jpg
Dimension: 300 x 300
Output:    69530 bytes (6.18 bpp)
Lossless-ARGB compressed size: 69530 bytes
  * Header size: 2231 bytes, image data size: 67273
  * Lossless features used: PREDICTION CROSS-COLOR-TRANSFORM SUBTRACT-GREEN
  * Precision Bits: histogram=3 transform=3 cache=10

Executing cwebp binary took: 211 ms

Success
Reduction: -152% (went from 27 kb to 68 kb)

Picking lossy
cwebp succeeded :)

Converted image in 617 ms, reducing file size with 39% (went from 27 kb to 16 kb)
