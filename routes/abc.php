<?xml version="1.0" encoding="utf-8"?>
<Project ToolsVersion="15.0" xmlns="http://schemas.microsoft.com/developer/msbuild/2003">
  <Import Project="..\packages\EntityFramework.6.5.1\build\EntityFramework.props" Condition="Exists('..\packages\EntityFramework.6.5.1\build\EntityFramework.props')" />
  <Import Project="$(MSBuildExtensionsPath)\$(MSBuildToolsVersion)\Microsoft.Common.props" Condition="Exists('$(MSBuildExtensionsPath)\$(MSBuildToolsVersion)\Microsoft.Common.props')" />
  <PropertyGroup>
    <Configuration Condition=" '$(Configuration)' == '' ">Debug</Configuration>
    <Platform Condition=" '$(Platform)' == '' ">AnyCPU</Platform>
    <ProjectGuid>{ED1C3713-E2ED-40FE-A0F8-E8C629AF3C1C}</ProjectGuid>
    <OutputType>WinExe</OutputType>
    <RootNamespace>FormTourTravel</RootNamespace>
    <AssemblyName>FormTourTravel</AssemblyName>
    <TargetFrameworkVersion>v4.7.2</TargetFrameworkVersion>
    <FileAlignment>512</FileAlignment>
    <AutoGenerateBindingRedirects>true</AutoGenerateBindingRedirects>
    <Deterministic>true</Deterministic>
    <TargetFrameworkProfile />
    <NuGetPackageImportStamp>
    </NuGetPackageImportStamp>
  </PropertyGroup>
  <PropertyGroup Condition=" '$(Configuration)|$(Platform)' == 'Debug|AnyCPU' ">
    <PlatformTarget>AnyCPU</PlatformTarget>
    <DebugSymbols>true</DebugSymbols>
    <DebugType>full</DebugType>
    <Optimize>false</Optimize>
    <OutputPath>bin\Debug\</OutputPath>
    <DefineConstants>DEBUG;TRACE</DefineConstants>
    <ErrorReport>prompt</ErrorReport>
    <WarningLevel>4</WarningLevel>
  </PropertyGroup>
  <PropertyGroup Condition=" '$(Configuration)|$(Platform)' == 'Release|AnyCPU' ">
    <PlatformTarget>AnyCPU</PlatformTarget>
    <DebugType>pdbonly</DebugType>
    <Optimize>true</Optimize>
    <OutputPath>bin\Release\</OutputPath>
    <DefineConstants>TRACE</DefineConstants>
    <ErrorReport>prompt</ErrorReport>
    <WarningLevel>4</WarningLevel>
  </PropertyGroup>
  <ItemGroup>
    <Reference Include="BCrypt.Net-Next, Version=4.0.3.0, Culture=neutral, PublicKeyToken=1e11be04b6288443, processorArchitecture=MSIL">
      <HintPath>..\packages\BCrypt.Net-Next.4.0.3\lib\net472\BCrypt.Net-Next.dll</HintPath>
    </Reference>
    <Reference Include="BouncyCastle.Crypto, Version=1.8.9.0, Culture=neutral, PublicKeyToken=0e99375e54769942">
      <HintPath>..\packages\BouncyCastle.1.8.9\lib\BouncyCastle.Crypto.dll</HintPath>
    </Reference>
    <Reference Include="BouncyCastle.Cryptography, Version=2.0.0.0, Culture=neutral, PublicKeyToken=072edcf4a5328938, processorArchitecture=MSIL">
      <HintPath>..\packages\BouncyCastle.Cryptography.2.5.0\lib\net461\BouncyCastle.Cryptography.dll</HintPath>
    </Reference>
    <Reference Include="DevExpress.Charts.v22.2.Core, Version=22.2.3.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" />
    <Reference Include="DevExpress.Dashboard.v22.2.Core, Version=22.2.3.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" />
    <Reference Include="DevExpress.Dashboard.v22.2.Win, Version=22.2.3.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a, processorArchitecture=MSIL" />
    <Reference Include="DevExpress.Data.Desktop.v22.2, Version=22.2.3.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a, processorArchitecture=MSIL" />
    <Reference Include="DevExpress.Data.v22.2, Version=22.2.3.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a, processorArchitecture=MSIL" />
    <Reference Include="DevExpress.DataAccess.v22.2, Version=22.2.3.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" />
    <Reference Include="DevExpress.DataAccess.v22.2.UI, Version=22.2.3.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" />
    <Reference Include="DevExpress.Drawing.v22.2, Version=22.2.3.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a, processorArchitecture=MSIL" />
    <Reference Include="DevExpress.Images.v22.2, Version=22.2.3.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a, processorArchitecture=MSIL" />
    <Reference Include="DevExpress.Map.v22.2.Core, Version=22.2.3.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" />
    <Reference Include="DevExpress.Office.v22.2.Core, Version=22.2.3.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" />
    <Reference Include="DevExpress.PivotGrid.v22.2.Core, Version=22.2.3.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" />
    <Reference Include="DevExpress.Printing.v22.2.Core, Version=22.2.3.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a, processorArchitecture=MSIL" />
    <Reference Include="DevExpress.RichEdit.v22.2.Core, Version=22.2.3.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" />
    <Reference Include="DevExpress.Sparkline.v22.2.Core, Version=22.2.3.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" />
    <Reference Include="DevExpress.TreeMap.v22.2.Core, Version=22.2.3.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" />
    <Reference Include="DevExpress.Utils.v22.2, Version=22.2.3.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a, processorArchitecture=MSIL" />
    <Reference Include="DevExpress.Utils.v22.2.UI, Version=22.2.3.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" />
    <Reference Include="DevExpress.Xpo.v22.2, Version=22.2.3.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" />
    <Reference Include="DevExpress.XtraBars.v22.2, Version=22.2.3.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a, processorArchitecture=MSIL" />
    <Reference Include="DevExpress.XtraCharts.v22.2, Version=22.2.3.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" />
    <Reference Include="DevExpress.XtraCharts.v22.2.UI, Version=22.2.3.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" />
    <Reference Include="DevExpress.XtraCharts.v22.2.Wizard, Version=22.2.3.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" />
    <Reference Include="DevExpress.XtraEditors.v22.2, Version=22.2.3.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a, processorArchitecture=MSIL" />
    <Reference Include="DevExpress.XtraGauges.v22.2.Core, Version=22.2.3.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" />
    <Reference Include="DevExpress.XtraGauges.v22.2.Presets, Version=22.2.3.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" />
    <Reference Include="DevExpress.XtraGauges.v22.2.Win, Version=22.2.3.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" />
    <Reference Include="DevExpress.XtraGrid.v22.2, Version=22.2.3.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a, processorArchitecture=MSIL" />
    <Reference Include="DevExpress.XtraLayout.v22.2, Version=22.2.3.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a, processorArchitecture=MSIL" />
    <Reference Include="DevExpress.XtraMap.v22.2, Version=22.2.3.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" />
    <Reference Include="DevExpress.XtraPivotGrid.v22.2, Version=22.2.3.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" />
    <Reference Include="DevExpress.XtraPrinting.v22.2, Version=22.2.3.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" />
    <Reference Include="DevExpress.XtraReports.v22.2, Version=22.2.3.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" />
    <Reference Include="DevExpress.XtraRichEdit.v22.2, Version=22.2.3.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" />
    <Reference Include="DevExpress.XtraTreeList.v22.2, Version=22.2.3.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" />
    <Reference Include="DevExpress.XtraTreeMap.v22.2, Version=22.2.3.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" />
    <Reference Include="DevExpress.XtraTreeMap.v22.2.UI, Version=22.2.3.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" />
    <Reference Include="EntityFramework, Version=6.0.0.0, Culture=neutral, PublicKeyToken=b77a5c561934e089, processorArchitecture=MSIL">
      <HintPath>..\packages\EntityFramework.6.5.1\lib\net45\EntityFramework.dll</HintPath>
    </Reference>
    <Reference Include="EntityFramework.SqlServer, Version=6.0.0.0, Culture=neutral, PublicKeyToken=b77a5c561934e089, processorArchitecture=MSIL">
      <HintPath>..\packages\EntityFramework.6.5.1\lib\net45\EntityFramework.SqlServer.dll</HintPath>
    </Reference>
    <Reference Include="EPPlus, Version=7.5.1.0, Culture=neutral, PublicKeyToken=ea159fdaa78159a1, processorArchitecture=MSIL">
      <HintPath>..\packages\EPPlus.7.5.1\lib\net462\EPPlus.dll</HintPath>
    </Reference>
    <Reference Include="EPPlus.Interfaces, Version=7.5.0.0, Culture=neutral, PublicKeyToken=a694d7f3b0907a61, processorArchitecture=MSIL">
      <HintPath>..\packages\EPPlus.Interfaces.7.5.0\lib\net462\EPPlus.Interfaces.dll</HintPath>
    </Reference>
    <Reference Include="EPPlus.System.Drawing, Version=7.5.0.0, Culture=neutral, PublicKeyToken=2308d35469c9bac0, processorArchitecture=MSIL">
      <HintPath>..\packages\EPPlus.System.Drawing.7.5.0\lib\net462\EPPlus.System.Drawing.dll</HintPath>
    </Reference>
    <Reference Include="Google.Protobuf, Version=3.29.0.0, Culture=neutral, PublicKeyToken=a7d26565bac4d604, processorArchitecture=MSIL">
      <HintPath>..\packages\Google.Protobuf.3.29.0\lib\net45\Google.Protobuf.dll</HintPath>
    </Reference>
    <Reference Include="K4os.Compression.LZ4, Version=1.3.8.0, Culture=neutral, PublicKeyToken=2186fa9121ef231d, processorArchitecture=MSIL">
      <HintPath>..\packages\K4os.Compression.LZ4.1.3.8\lib\net462\K4os.Compression.LZ4.dll</HintPath>
    </Reference>
    <Reference Include="K4os.Compression.LZ4.Streams, Version=1.3.8.0, Culture=neutral, PublicKeyToken=2186fa9121ef231d, processorArchitecture=MSIL">
      <HintPath>..\packages\K4os.Compression.LZ4.Streams.1.3.8\lib\net462\K4os.Compression.LZ4.Streams.dll</HintPath>
    </Reference>
    <Reference Include="K4os.Hash.xxHash, Version=1.0.8.0, Culture=neutral, PublicKeyToken=32cd54395057cec3, processorArchitecture=MSIL">
      <HintPath>..\packages\K4os.Hash.xxHash.1.0.8\lib\net462\K4os.Hash.xxHash.dll</HintPath>
    </Reference>
    <Reference Include="Microsoft.Bcl.AsyncInterfaces, Version=9.0.0.0, Culture=neutral, PublicKeyToken=cc7b13ffcd2ddd51, processorArchitecture=MSIL">
      <HintPath>..\packages\Microsoft.Bcl.AsyncInterfaces.9.0.0\lib\net462\Microsoft.Bcl.AsyncInterfaces.dll</HintPath>
    </Reference>
    <Reference Include="Microsoft.IO.RecyclableMemoryStream, Version=3.0.1.0, Culture=neutral, PublicKeyToken=31bf3856ad364e35, processorArchitecture=MSIL">
      <HintPath>..\packages\Microsoft.IO.RecyclableMemoryStream.3.0.1\lib\netstandard2.0\Microsoft.IO.RecyclableMemoryStream.dll</HintPath>
    </Reference>
    <Reference Include="MySql.Data, Version=9.1.0.0, Culture=neutral, PublicKeyToken=c5687fc88969c44d, processorArchitecture=MSIL">
      <HintPath>..\packages\MySql.Data.9.1.0\lib\net462\MySql.Data.dll</HintPath>
    </Reference>
    <Reference Include="MySql.Data.Entity.EF6, Version=6.9.10.0, Culture=neutral, PublicKeyToken=c5687fc88969c44d, processorArchitecture=MSIL">
      <SpecificVersion>False</SpecificVersion>
      <HintPath>C:\Program Files (x86)\MySQL\MySQL Connector Net 6.9.10\Assemblies\v4.5\MySql.Data.Entity.EF6.dll</HintPath>
    </Reference>
    <Reference Include="MySql.Data.EntityFramework, Version=9.1.0.0, Culture=neutral, PublicKeyToken=c5687fc88969c44d, processorArchitecture=MSIL">
      <HintPath>..\packages\MySql.Data.EntityFramework.9.1.0\lib\net462\MySql.Data.EntityFramework.dll</HintPath>
    </Reference>
    <Reference Include="MySql.Web, Version=6.9.10.0, Culture=neutral, PublicKeyToken=c5687fc88969c44d, processorArchitecture=MSIL">
      <SpecificVersion>False</SpecificVersion>
      <HintPath>C:\Program Files (x86)\MySQL\MySQL Connector Net 6.9.10\Assemblies\v4.5\MySql.Web.dll</HintPath>
    </Reference>
    <Reference Include="PresentationCore" />
    <Reference Include="Renci.SshNet, Version=2024.2.0.1, Culture=neutral, PublicKeyToken=1cee9f8bde3db106, processorArchitecture=MSIL">
      <HintPath>..\packages\SSH.NET.2024.2.0\lib\net462\Renci.SshNet.dll</HintPath>
    </Reference>
    <Reference Include="System" />
    <Reference Include="System.Buffers, Version=4.0.4.0, Culture=neutral, PublicKeyToken=cc7b13ffcd2ddd51, processorArchitecture=MSIL">
      <HintPath>..\packages\System.Buffers.4.6.0\lib\net462\System.Buffers.dll</HintPath>
    </Reference>
    <Reference Include="System.ComponentModel" />
    <Reference Include="System.ComponentModel.Annotations, Version=4.2.1.0, Culture=neutral, PublicKeyToken=b03f5f7f11d50a3a, processorArchitecture=MSIL">
      <HintPath>..\packages\System.ComponentModel.Annotations.5.0.0\lib\net461\System.ComponentModel.Annotations.dll</HintPath>
    </Reference>
    <Reference Include="System.ComponentModel.DataAnnotations" />
    <Reference Include="System.Configuration" />
    <Reference Include="System.Configuration.ConfigurationManager, Version=9.0.0.0, Culture=neutral, PublicKeyToken=cc7b13ffcd2ddd51, processorArchitecture=MSIL">
      <HintPath>..\packages\System.Configuration.ConfigurationManager.9.0.0\lib\net462\System.Configuration.ConfigurationManager.dll</HintPath>
    </Reference>
    <Reference Include="System.Configuration.Install" />
    <Reference Include="System.Core" />
    <Reference Include="System.Data.Entity" />
    <Reference Include="System.Diagnostics.DiagnosticSource, Version=9.0.0.0, Culture=neutral, PublicKeyToken=cc7b13ffcd2ddd51, processorArchitecture=MSIL">
      <HintPath>..\packages\System.Diagnostics.DiagnosticSource.9.0.0\lib\net462\System.Diagnostics.DiagnosticSource.dll</HintPath>
    </Reference>
    <Reference Include="System.Drawing.Common, Version=8.0.0.0, Culture=neutral, PublicKeyToken=cc7b13ffcd2ddd51, processorArchitecture=MSIL">
      <HintPath>..\packages\System.Drawing.Common.8.0.4\lib\net462\System.Drawing.Common.dll</HintPath>
    </Reference>
    <Reference Include="System.Drawing.Design" />
    <Reference Include="System.Formats.Asn1, Version=8.0.0.1, Culture=neutral, PublicKeyToken=cc7b13ffcd2ddd51, processorArchitecture=MSIL">
      <HintPath>..\packages\System.Formats.Asn1.8.0.1\lib\net462\System.Formats.Asn1.dll</HintPath>
    </Reference>
    <Reference Include="System.IO.Pipelines, Version=9.0.0.0, Culture=neutral, PublicKeyToken=cc7b13ffcd2ddd51, processorArchitecture=MSIL">
      <HintPath>..\packages\System.IO.Pipelines.9.0.0\lib\net462\System.IO.Pipelines.dll</HintPath>
    </Reference>
    <Reference Include="System.Management" />
    <Reference Include="System.Memory, Version=4.0.2.0, Culture=neutral, PublicKeyToken=cc7b13ffcd2ddd51, processorArchitecture=MSIL">
      <HintPath>..\packages\System.Memory.4.6.0\lib\net462\System.Memory.dll</HintPath>
    </Reference>
    <Reference Include="System.Numerics" />
    <Reference Include="System.Numerics.Vectors, Version=4.1.5.0, Culture=neutral, PublicKeyToken=b03f5f7f11d50a3a, processorArchitecture=MSIL">
      <HintPath>..\packages\System.Numerics.Vectors.4.6.0\lib\net462\System.Numerics.Vectors.dll</HintPath>
    </Reference>
    <Reference Include="System.Runtime.CompilerServices.Unsafe, Version=6.0.1.0, Culture=neutral, PublicKeyToken=b03f5f7f11d50a3a, processorArchitecture=MSIL">
      <HintPath>..\packages\System.Runtime.CompilerServices.Unsafe.6.1.0\lib\net462\System.Runtime.CompilerServices.Unsafe.dll</HintPath>
    </Reference>
    <Reference Include="System.Runtime.Serialization" />
    <Reference Include="System.Security" />
    <Reference Include="System.Threading.Tasks.Extensions, Version=4.2.1.0, Culture=neutral, PublicKeyToken=cc7b13ffcd2ddd51, processorArchitecture=MSIL">
      <HintPath>..\packages\System.Threading.Tasks.Extensions.4.6.0\lib\net462\System.Threading.Tasks.Extensions.dll</HintPath>
    </Reference>
    <Reference Include="System.Transactions" />
    <Reference Include="System.ValueTuple, Version=4.0.3.0, Culture=neutral, PublicKeyToken=cc7b13ffcd2ddd51, processorArchitecture=MSIL">
      <HintPath>..\packages\System.ValueTuple.4.5.0\lib\net47\System.ValueTuple.dll</HintPath>
    </Reference>
    <Reference Include="System.Xml.Linq" />
    <Reference Include="System.Data.DataSetExtensions" />
    <Reference Include="Microsoft.CSharp" />
    <Reference Include="System.Data" />
    <Reference Include="System.Deployment" />
    <Reference Include="System.Drawing" />
    <Reference Include="System.Net.Http" />
    <Reference Include="System.Windows.Forms" />
    <Reference Include="System.Xml" />
    <Reference Include="ZstdSharp, Version=0.8.3.0, Culture=neutral, PublicKeyToken=8d151af33a4ad5cf, processorArchitecture=MSIL">
      <HintPath>..\packages\ZstdSharp.Port.0.8.3\lib\net462\ZstdSharp.dll</HintPath>
    </Reference>
  </ItemGroup>
  <ItemGroup>
    <Compile Include="frm_AddTourDX.cs">
      <SubType>Form</SubType>
    </Compile>
    <Compile Include="frm_AddTourDX.Designer.cs">
      <DependentUpon>frm_AddTourDX.cs</DependentUpon>
    </Compile>
    <Compile Include="frm_Blog.cs">
      <SubType>Form</SubType>
    </Compile>
    <Compile Include="frm_Blog.Designer.cs">
      <DependentUpon>frm_Blog.cs</DependentUpon>
    </Compile>
    <Compile Include="frm_CapTaiKhoan.cs">
      <SubType>Form</SubType>
    </Compile>
    <Compile Include="frm_CapTaiKhoan.Designer.cs">
      <DependentUpon>frm_CapTaiKhoan.cs</DependentUpon>
    </Compile>
    <Compile Include="frm_DangKy.cs">
      <SubType>Form</SubType>
    </Compile>
    <Compile Include="frm_DangKy.Designer.cs">
      <DependentUpon>frm_DangKy.cs</DependentUpon>
    </Compile>
    <Compile Include="frm_DangNhap.cs">
      <SubType>Form</SubType>
    </Compile>
    <Compile Include="frm_DangNhap.Designer.cs">
      <DependentUpon>frm_DangNhap.cs</DependentUpon>
    </Compile>
    <Compile Include="frm_KhachHang.cs">
      <SubType>Form</SubType>
    </Compile>
    <Compile Include="frm_KhachHang.Designer.cs">
      <DependentUpon>frm_KhachHang.cs</DependentUpon>
    </Compile>
    <Compile Include="frm_LoaiBog.cs">
      <SubType>Form</SubType>
    </Compile>
    <Compile Include="frm_LoaiBog.Designer.cs">
      <DependentUpon>frm_LoaiBog.cs</DependentUpon>
    </Compile>
    <Compile Include="frm_Main.cs">
      <SubType>Form</SubType>
    </Compile>
    <Compile Include="frm_Main.Designer.cs">
      <DependentUpon>frm_Main.cs</DependentUpon>
    </Compile>
    <Compile Include="frm_NhanVien.cs">
      <SubType>Form</SubType>
    </Compile>
    <Compile Include="frm_NhanVien.Designer.cs">
      <DependentUpon>frm_NhanVien.cs</DependentUpon>
    </Compile>
    <Compile Include="frm_PhanCongNhanVien.cs">
      <SubType>Form</SubType>
    </Compile>
    <Compile Include="frm_PhanCongNhanVien.Designer.cs">
      <DependentUpon>frm_PhanCongNhanVien.cs</DependentUpon>
    </Compile>
    <Compile Include="frm_SaoLuuPhucHoi.cs">
      <SubType>Form</SubType>
    </Compile>
    <Compile Include="frm_SaoLuuPhucHoi.Designer.cs">
      <DependentUpon>frm_SaoLuuPhucHoi.cs</DependentUpon>
    </Compile>
    <Compile Include="frm_ThongTinTaiKhoan.cs">
      <SubType>Form</SubType>
    </Compile>
    <Compile Include="frm_ThongTinTaiKhoan.Designer.cs">
      <DependentUpon>frm_ThongTinTaiKhoan.cs</DependentUpon>
    </Compile>
    <Compile Include="frm_Tour.cs">
      <SubType>Form</SubType>
    </Compile>
    <Compile Include="frm_Tour.Designer.cs">
      <DependentUpon>frm_Tour.cs</DependentUpon>
    </Compile>
    <Compile Include="frm_XacNhanDatTour.cs">
      <SubType>Form</SubType>
    </Compile>
    <Compile Include="frm_XacNhanDatTour.Designer.cs">
      <DependentUpon>frm_XacNhanDatTour.cs</DependentUpon>
    </Compile>
    <Compile Include="Program.cs" />
    <Compile Include="Properties\AssemblyInfo.cs" />
    <Compile Include="RibbonForm1.cs">
      <SubType>Form</SubType>
    </Compile>
    <Compile Include="RibbonForm1.Designer.cs">
      <DependentUpon>RibbonForm1.cs</DependentUpon>
    </Compile>
    <Compile Include="SplashScreen1.cs">
      <SubType>Form</SubType>
    </Compile>
    <Compile Include="SplashScreen1.Designer.cs">
      <DependentUpon>SplashScreen1.cs</DependentUpon>
    </Compile>
    <Compile Include="WaitForm1.cs">
      <SubType>Form</SubType>
    </Compile>
    <Compile Include="WaitForm1.Designer.cs">
      <DependentUpon>WaitForm1.cs</DependentUpon>
    </Compile>
    <Compile Include="frm_ChiTietTour.cs">
      <SubType>Form</SubType>
    </Compile>
    <Compile Include="frm_ChiTietTour.Designer.cs">
      <DependentUpon>frm_ChiTietTour.cs</DependentUpon>
    </Compile>
    <Compile Include="frm_TourDX.cs">
      <SubType>Form</SubType>
    </Compile>
    <Compile Include="frm_TourDX.Designer.cs">
      <DependentUpon>frm_TourDX.cs</DependentUpon>
    </Compile>
    <Compile Include="frm_ChuongTrinhTour.cs">
      <SubType>Form</SubType>
    </Compile>
    <Compile Include="frm_ChuongTrinhTour.Designer.cs">
      <DependentUpon>frm_ChuongTrinhTour.cs</DependentUpon>
    </Compile>
    <Compile Include="frm_PhuongTienTour.cs">
      <SubType>Form</SubType>
    </Compile>
    <Compile Include="frm_PhuongTienTour.Designer.cs">
      <DependentUpon>frm_PhuongTienTour.cs</DependentUpon>
    </Compile>
    <Compile Include="frm_KhachSanTour.cs">
      <SubType>Form</SubType>
    </Compile>
    <Compile Include="frm_KhachSanTour.Designer.cs">
      <DependentUpon>frm_KhachSanTour.cs</DependentUpon>
    </Compile>
    <Compile Include="frm_TourTypecs.cs">
      <SubType>Form</SubType>
    </Compile>
    <Compile Include="frm_TourTypecs.Designer.cs">
      <DependentUpon>frm_TourTypecs.cs</DependentUpon>
    </Compile>
    <EmbeddedResource Include="frm_AddTourDX.resx">
      <DependentUpon>frm_AddTourDX.cs</DependentUpon>
    </EmbeddedResource>
    <EmbeddedResource Include="frm_CapTaiKhoan.resx">
      <DependentUpon>frm_CapTaiKhoan.cs</DependentUpon>
    </EmbeddedResource>
    <EmbeddedResource Include="frm_ChiTietTour.resx">
      <DependentUpon>frm_ChiTietTour.cs</DependentUpon>
    </EmbeddedResource>
    <EmbeddedResource Include="frm_ChuongTrinhTour.resx">
      <DependentUpon>frm_ChuongTrinhTour.cs</DependentUpon>
    </EmbeddedResource>
    <EmbeddedResource Include="frm_DangNhap.resx">
      <DependentUpon>frm_DangNhap.cs</DependentUpon>
    </EmbeddedResource>
    <EmbeddedResource Include="frm_KhachSanTour.resx">
      <DependentUpon>frm_KhachSanTour.cs</DependentUpon>
    </EmbeddedResource>
    <EmbeddedResource Include="frm_Main.resx">
      <DependentUpon>frm_Main.cs</DependentUpon>
    </EmbeddedResource>
    <EmbeddedResource Include="frm_NhanVien.resx">
      <DependentUpon>frm_NhanVien.cs</DependentUpon>
    </EmbeddedResource>
    <EmbeddedResource Include="frm_PhuongTienTour.resx">
      <DependentUpon>frm_PhuongTienTour.cs</DependentUpon>
    </EmbeddedResource>
    <EmbeddedResource Include="frm_ThongTinTaiKhoan.resx">
      <DependentUpon>frm_ThongTinTaiKhoan.cs</DependentUpon>
    </EmbeddedResource>
    <EmbeddedResource Include="frm_Tour.resx">
      <DependentUpon>frm_Tour.cs</DependentUpon>
    </EmbeddedResource>
    <EmbeddedResource Include="frm_TourDX.resx">
      <DependentUpon>frm_TourDX.cs</DependentUpon>
    </EmbeddedResource>
    <EmbeddedResource Include="frm_TourTypecs.resx">
      <DependentUpon>frm_TourTypecs.cs</DependentUpon>
    </EmbeddedResource>
    <EmbeddedResource Include="Properties\licenses.licx" />
    <EmbeddedResource Include="Properties\Resources.resx">
      <Generator>PublicResXFileCodeGenerator</Generator>
      <SubType>Designer</SubType>
      <LastGenOutput>Resources.Designer.cs</LastGenOutput>
    </EmbeddedResource>
    <EmbeddedResource Include="RibbonForm1.resx">
      <DependentUpon>RibbonForm1.cs</DependentUpon>
    </EmbeddedResource>
    <EmbeddedResource Include="SplashScreen1.resx">
      <DependentUpon>SplashScreen1.cs</DependentUpon>
    </EmbeddedResource>
    <EmbeddedResource Include="WaitForm1.resx">
      <DependentUpon>WaitForm1.cs</DependentUpon>
    </EmbeddedResource>
    <None Include="packages.config" />
    <None Include="Properties\Settings.settings">
      <Generator>SettingsSingleFileGenerator</Generator>
      <LastGenOutput>Settings.Designer.cs</LastGenOutput>
    </None>
    <Compile Include="Properties\Resources.Designer.cs">
      <AutoGen>True</AutoGen>
      <DesignTime>True</DesignTime>
      <DependentUpon>Resources.resx</DependentUpon>
    </Compile>
    <Compile Include="Properties\Settings.Designer.cs">
      <AutoGen>True</AutoGen>
      <DependentUpon>Settings.settings</DependentUpon>
      <DesignTimeSharedInput>True</DesignTimeSharedInput>
    </Compile>
  </ItemGroup>
  <ItemGroup>
    <None Include="App.config">
      <SubType>Designer</SubType>
    </None>
  </ItemGroup>
  <ItemGroup>
    <Service Include="{508349B6-6B84-4DF5-91F0-309BEEBAD82D}" />
  </ItemGroup>
  <ItemGroup>
    <None Include="Resources\hinh_dai_dien_dang_nhap.jpg" />
  </ItemGroup>
  <ItemGroup>
    <ProjectReference Include="..\BLL\BLL.csproj">
      <Project>{40f61705-4f1c-4b0a-bcf2-4e094e984de9}</Project>
      <Name>BLL</Name>
    </ProjectReference>
    <ProjectReference Include="..\DTO\DTO.csproj">
      <Project>{c4a260c2-f225-40e9-ab5d-7fbdd800b761}</Project>
      <Name>DTO</Name>
    </ProjectReference>
    <ProjectReference Include="..\ThuVien\ThuVien.csproj">
      <Project>{5c440904-1e30-49e6-bd3c-177e08bf99df}</Project>
      <Name>ThuVien</Name>
    </ProjectReference>
  </ItemGroup>
  <ItemGroup>
    <Content Include="ILLink\ILLink.Descriptors.LibraryBuild.xml" />
  </ItemGroup>
  <Import Project="$(MSBuildToolsPath)\Microsoft.CSharp.targets" />
  <Target Name="EnsureNuGetPackageBuildImports" BeforeTargets="PrepareForBuild">
    <PropertyGroup>
      <ErrorText>This project references NuGet package(s) that are missing on this computer. Use NuGet Package Restore to download them.  For more information, see http://go.microsoft.com/fwlink/?LinkID=322105. The missing file is {0}.</ErrorText>
    </PropertyGroup>
    <Error Condition="!Exists('..\packages\EntityFramework.6.5.1\build\EntityFramework.props')" Text="$([System.String]::Format('$(ErrorText)', '..\packages\EntityFramework.6.5.1\build\EntityFramework.props'))" />
    <Error Condition="!Exists('..\packages\EntityFramework.6.5.1\build\EntityFramework.targets')" Text="$([System.String]::Format('$(ErrorText)', '..\packages\EntityFramework.6.5.1\build\EntityFramework.targets'))" />
  </Target>
  <Import Project="..\packages\EntityFramework.6.5.1\build\EntityFramework.targets" Condition="Exists('..\packages\EntityFramework.6.5.1\build\EntityFramework.targets')" />
</Project>  <None Include="Resources\iphone_16_pro_max_white_titan_5_267e1eaab9.png" />
