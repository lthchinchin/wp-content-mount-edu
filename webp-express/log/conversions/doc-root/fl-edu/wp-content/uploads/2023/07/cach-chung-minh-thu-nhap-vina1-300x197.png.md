WebP Express 0.25.6. Conversion triggered with the conversion script (wod/webp-on-demand.php), 2023-07-24 12:13:45

**WebP Convert 2.9.0 ignited** 
PHP version: 7.4.30
Server software: Apache/2.4.54 (Win64) OpenSSL/1.1.1p PHP/7.4.30

source: [doc-root]/fl-edu/wp-content/uploads/2023/07/cach-chung-minh-thu-nhap-vina1-300x197.png
destination: C:\xampp\htdocs\fl-edu\wp-content\webp-express/webp-images/uploads/2023\07\cach-chung-minh-thu-nhap-vina1-300x197.png.webp

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

Nope a plain cwebp call does not work (spent 36 ms)
Discovering binaries using "which -a cwebp" command. (to skip this step, disable the "try-discovering-cwebp" option)
Found 0 binaries (spent 91 ms)
Discovering binaries by peeking in common system paths (to skip this step, disable the "try-common-system-paths" option)
Found 0 binaries (spent 1 ms)
Discovering binaries which are distributed with the webp-convert library (to skip this step, disable the "try-supplied-binary-for-os" option)
Checking if we have a supplied precompiled binary for your OS (WINNT)... We do. We in fact have 2
Found 2 binaries (spent 1 ms)
- C:\xampp\htdocs\fl-edu\wp-content\plugins\webp-express\vendor\rosell-dk\webp-convert\src\Convert\Converters\Binaries\cwebp-120-windows-x64.exe
- C:\xampp\htdocs\fl-edu\wp-content\plugins\webp-express\vendor\rosell-dk\webp-convert\src\Convert\Converters\Binaries\cwebp-110-windows-x64.exe
Discovering cwebp binaries took: 128 ms

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
C:\xampp\htdocs\fl-edu\wp-content\plugins\webp-express\vendor\rosell-dk\webp-convert\src\Convert\Converters\Binaries\cwebp-120-windows-x64.exe -metadata none -q 85 -alpha_q "80" -sharp_yuv -m 6 -low_memory "[doc-root]/fl-edu/wp-content/uploads/2023/07/cach-chung-minh-thu-nhap-vina1-300x197.png" -o "C:\xampp\htdocs\fl-edu\wp-content\webp-express/webp-images/uploads/2023\07\cach-chung-minh-thu-nhap-vina1-300x197.png.webp.lossy.webp" 2>&1

*Output:* 
Saving file 'C:\xampp\htdocs\fl-edu\wp-content\webp-express/webp-images/uploads/2023\07\cach-chung-minh-thu-nhap-vina1-300x197.png.webp.lossy.webp'
File:      [doc-root]/fl-edu/wp-content/uploads/2023/07/cach-chung-minh-thu-nhap-vina1-300x197.png
Dimension: 300 x 197
Output:    12672 bytes Y-U-V-All-PSNR 41.07 42.35 42.27   41.45 dB
           (1.72 bpp)
block count:  intra4:        234  (94.74%)
              intra16:        13  (5.26%)
              skipped:         1  (0.40%)
bytes used:  header:            222  (1.8%)
             mode-partition:   1243  (9.8%)
 Residuals bytes  |segment 1|segment 2|segment 3|segment 4|  total
  intra4-coeffs:  |    1356 |    2695 |    3639 |     698 |    8388  (66.2%)
 intra16-coeffs:  |       0 |       0 |      20 |     131 |     151  (1.2%)
  chroma coeffs:  |     298 |     878 |    1178 |     285 |    2639  (20.8%)
    macroblocks:  |       7%|      21%|      49%|      23%|     247
      quantizer:  |      20 |      17 |      13 |      10 |
   filter level:  |       7 |       4 |       2 |       7 |
------------------+---------+---------+---------+---------+-----------------
 segments total:  |    1654 |    3573 |    4837 |    1114 |   11178  (88.2%)

Executing cwebp binary took: 72 ms

Success
Reduction: 57% (went from 29 kb to 12 kb)

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
Checksum test took: 3 ms
Creating command line options for version: 1.2.0
Trying to convert by executing the following command:
C:\xampp\htdocs\fl-edu\wp-content\plugins\webp-express\vendor\rosell-dk\webp-convert\src\Convert\Converters\Binaries\cwebp-120-windows-x64.exe -metadata none -q 85 -alpha_q "80" -near_lossless 60 -sharp_yuv -m 6 -low_memory "[doc-root]/fl-edu/wp-content/uploads/2023/07/cach-chung-minh-thu-nhap-vina1-300x197.png" -o "C:\xampp\htdocs\fl-edu\wp-content\webp-express/webp-images/uploads/2023\07\cach-chung-minh-thu-nhap-vina1-300x197.png.webp.lossless.webp" 2>&1

*Output:* 
Saving file 'C:\xampp\htdocs\fl-edu\wp-content\webp-express/webp-images/uploads/2023\07\cach-chung-minh-thu-nhap-vina1-300x197.png.webp.lossless.webp'
File:      [doc-root]/fl-edu/wp-content/uploads/2023/07/cach-chung-minh-thu-nhap-vina1-300x197.png
Dimension: 300 x 197
Output:    27714 bytes (3.75 bpp)
Lossless-ARGB compressed size: 27714 bytes
  * Header size: 896 bytes, image data size: 26792
  * Lossless features used: PALETTE
  * Precision Bits: histogram=3 transform=3 cache=2
  * Palette size:   186

Executing cwebp binary took: 73 ms

Success
Reduction: 5% (went from 29 kb to 27 kb)

Picking lossy
cwebp succeeded :)

Converted image in 475 ms, reducing file size with 57% (went from 29 kb to 12 kb)
