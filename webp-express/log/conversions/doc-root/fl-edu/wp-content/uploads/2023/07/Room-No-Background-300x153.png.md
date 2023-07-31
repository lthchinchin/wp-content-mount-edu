WebP Express 0.25.6. Conversion triggered with the conversion script (wod/webp-on-demand.php), 2023-07-24 12:13:47

**WebP Convert 2.9.0 ignited** 
PHP version: 7.4.30
Server software: Apache/2.4.54 (Win64) OpenSSL/1.1.1p PHP/7.4.30

source: [doc-root]/fl-edu/wp-content/uploads/2023/07/Room-No-Background-300x153.png
destination: C:\xampp\htdocs\fl-edu\wp-content\webp-express/webp-images/uploads/2023\07\Room-No-Background-300x153.png.webp

**Stack converter ignited** 

Options:
------------
- encoding: "auto"
- quality: 85
- alpha-quality: 80
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
- quality: 85
- alpha-quality: 80
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

Nope a plain cwebp call does not work (spent 23 ms)
Discovering binaries using "which -a cwebp" command. (to skip this step, disable the "try-discovering-cwebp" option)
Found 0 binaries (spent 90 ms)
Discovering binaries by peeking in common system paths (to skip this step, disable the "try-common-system-paths" option)
Found 0 binaries (spent 1 ms)
Discovering binaries which are distributed with the webp-convert library (to skip this step, disable the "try-supplied-binary-for-os" option)
Checking if we have a supplied precompiled binary for your OS (WINNT)... We do. We in fact have 2
Found 2 binaries (spent 1 ms)
- C:\xampp\htdocs\fl-edu\wp-content\plugins\webp-express\vendor\rosell-dk\webp-convert\src\Convert\Converters\Binaries\cwebp-120-windows-x64.exe
- C:\xampp\htdocs\fl-edu\wp-content\plugins\webp-express\vendor\rosell-dk\webp-convert\src\Convert\Converters\Binaries\cwebp-110-windows-x64.exe
Discovering cwebp binaries took: 115 ms

Binaries ordered by version number.
- C:\xampp\htdocs\fl-edu\wp-content\plugins\webp-express\vendor\rosell-dk\webp-convert\src\Convert\Converters\Binaries\cwebp-120-windows-x64.exe: (version: 1.2.0)
- C:\xampp\htdocs\fl-edu\wp-content\plugins\webp-express\vendor\rosell-dk\webp-convert\src\Convert\Converters\Binaries\cwebp-110-windows-x64.exe: (version: 1.1.0)
Starting conversion, using the first of these. If that should fail, the next will be tried and so on.
**No "nice" support. To save a few ms, you can disable the "use-nice" option.**
Checking checksum for supplied binary: C:\xampp\htdocs\fl-edu\wp-content\plugins\webp-express\vendor\rosell-dk\webp-convert\src\Convert\Converters\Binaries\cwebp-120-windows-x64.exe
Checksum test took: 4 ms
Creating command line options for version: 1.2.0
Bypassing auto-limit (it is only active for jpegs)
Quality: 85. 
The near-lossless option ignored for lossy
Trying to convert by executing the following command:
C:\xampp\htdocs\fl-edu\wp-content\plugins\webp-express\vendor\rosell-dk\webp-convert\src\Convert\Converters\Binaries\cwebp-120-windows-x64.exe -metadata none -q 85 -alpha_q "80" -sharp_yuv -m 6 -low_memory "[doc-root]/fl-edu/wp-content/uploads/2023/07/Room-No-Background-300x153.png" -o "C:\xampp\htdocs\fl-edu\wp-content\webp-express/webp-images/uploads/2023\07\Room-No-Background-300x153.png.webp.lossy.webp" 2>&1

*Output:* 
Saving file 'C:\xampp\htdocs\fl-edu\wp-content\webp-express/webp-images/uploads/2023\07\Room-No-Background-300x153.png.webp.lossy.webp'
File:      [doc-root]/fl-edu/wp-content/uploads/2023/07/Room-No-Background-300x153.png
Dimension: 300 x 153 (with alpha)
Output:    4200 bytes Y-U-V-All-PSNR 44.00 47.09 46.03   44.69 dB
           (0.73 bpp)
block count:  intra4:        124  (65.26%)
              intra16:        66  (34.74%)
              skipped:        28  (14.74%)
bytes used:  header:             97  (2.3%)
             mode-partition:    644  (15.3%)
             transparency:      976 (99.0 dB)
 Residuals bytes  |segment 1|segment 2|segment 3|segment 4|  total
  intra4-coeffs:  |     468 |     405 |     322 |     276 |    1471  (35.0%)
 intra16-coeffs:  |       0 |      75 |      90 |      95 |     260  (6.2%)
  chroma coeffs:  |     226 |     249 |     119 |     104 |     698  (16.6%)
    macroblocks:  |      13%|      25%|      18%|      44%|     190
      quantizer:  |      20 |      18 |      13 |       9 |
   filter level:  |       7 |       4 |       9 |       5 |
------------------+---------+---------+---------+---------+-----------------
 segments total:  |     694 |     729 |     531 |     475 |    2429  (57.8%)
Lossless-alpha compressed size: 975 bytes
  * Header size: 39 bytes, image data size: 936
  * Precision Bits: histogram=3 transform=3 cache=0
  * Palette size:   18

Executing cwebp binary took: 89 ms

Success
Reduction: 52% (went from 8817 bytes to 4200 bytes)

Converting to lossless
Looking for cwebp binaries.
Discovering if a plain cwebp call works (to skip this step, disable the "try-cwebp" option)
- Executing: cwebp -version 2>&1. Result: *Exec failed* (return code: 1)

*Output:* 
'cwebp' is not recognized as an internal or external command,
operable program or batch file.

Nope a plain cwebp call does not work (spent 30 ms)
Discovering binaries using "which -a cwebp" command. (to skip this step, disable the "try-discovering-cwebp" option)
Found 0 binaries (spent 76 ms)
Discovering binaries by peeking in common system paths (to skip this step, disable the "try-common-system-paths" option)
Found 0 binaries (spent 0 ms)
Discovering binaries which are distributed with the webp-convert library (to skip this step, disable the "try-supplied-binary-for-os" option)
Checking if we have a supplied precompiled binary for your OS (WINNT)... We do. We in fact have 2
Found 2 binaries (spent 0 ms)
- C:\xampp\htdocs\fl-edu\wp-content\plugins\webp-express\vendor\rosell-dk\webp-convert\src\Convert\Converters\Binaries\cwebp-120-windows-x64.exe
- C:\xampp\htdocs\fl-edu\wp-content\plugins\webp-express\vendor\rosell-dk\webp-convert\src\Convert\Converters\Binaries\cwebp-110-windows-x64.exe
Discovering cwebp binaries took: 106 ms

Binaries ordered by version number.
- C:\xampp\htdocs\fl-edu\wp-content\plugins\webp-express\vendor\rosell-dk\webp-convert\src\Convert\Converters\Binaries\cwebp-120-windows-x64.exe: (version: 1.2.0)
- C:\xampp\htdocs\fl-edu\wp-content\plugins\webp-express\vendor\rosell-dk\webp-convert\src\Convert\Converters\Binaries\cwebp-110-windows-x64.exe: (version: 1.1.0)
Starting conversion, using the first of these. If that should fail, the next will be tried and so on.
**No "nice" support. To save a few ms, you can disable the "use-nice" option.**
Checking checksum for supplied binary: C:\xampp\htdocs\fl-edu\wp-content\plugins\webp-express\vendor\rosell-dk\webp-convert\src\Convert\Converters\Binaries\cwebp-120-windows-x64.exe
Checksum test took: 3 ms
Creating command line options for version: 1.2.0
Trying to convert by executing the following command:
C:\xampp\htdocs\fl-edu\wp-content\plugins\webp-express\vendor\rosell-dk\webp-convert\src\Convert\Converters\Binaries\cwebp-120-windows-x64.exe -metadata none -q 85 -alpha_q "80" -near_lossless 60 -sharp_yuv -m 6 -low_memory "[doc-root]/fl-edu/wp-content/uploads/2023/07/Room-No-Background-300x153.png" -o "C:\xampp\htdocs\fl-edu\wp-content\webp-express/webp-images/uploads/2023\07\Room-No-Background-300x153.png.webp.lossless.webp" 2>&1

*Output:* 
Saving file 'C:\xampp\htdocs\fl-edu\wp-content\webp-express/webp-images/uploads/2023\07\Room-No-Background-300x153.png.webp.lossless.webp'
File:      [doc-root]/fl-edu/wp-content/uploads/2023/07/Room-No-Background-300x153.png
Dimension: 300 x 153
Output:    8442 bytes (1.47 bpp)
Lossless-ARGB compressed size: 8442 bytes
  * Header size: 419 bytes, image data size: 7998
  * Lossless features used: PALETTE
  * Precision Bits: histogram=3 transform=3 cache=2
  * Palette size:   68

Executing cwebp binary took: 73 ms

Success
Reduction: 4% (went from 8817 bytes to 8442 bytes)

Picking lossy
cwebp succeeded :)

Converted image in 458 ms, reducing file size with 52% (went from 8817 bytes to 4200 bytes)
